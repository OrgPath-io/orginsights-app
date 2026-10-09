/**
 * Standalone Express server for OrgInsights.
 *
 * Replaces the Hatch sandbox runtime:
 * - POST /api/actions  -> dispatches to the 63 actions in server/src/actions.ts
 * - GET  /blobs/*       -> serves uploaded files (question images)
 * - GET  /*             -> serves the React SPA
 *
 * Run: npm start
 * Env: PORT (default 5000), DATABASE_PATH, BLOB_DIR, SMTP_* vars
 */

import express from "express";
import { existsSync } from "node:fs";
import { join, dirname } from "node:path";
import { fileURLToPath } from "node:url";
import { randomUUID } from "node:crypto";
import { Actions } from "../src/actions";
import { isAction, type Ctx } from "./shim";
import { getDb, closeDb } from "./db";
import { blobClient, getBlobMimeType, getBlobPath } from "./blobs";
import { executePrivileged } from "./privileged-impl";

const __dirname = dirname(fileURLToPath(import.meta.url));
const app = express();
const PORT = Number(process.env.PORT || 5000);

// JSON body parsing (actions can include base64 images, allow large payloads)
app.use(express.json({ limit: "25mb" }));

// Build the per-request context
function createCtx(): Ctx {
  return {
    slug: "orginsights-app",
    invocationId: randomUUID(),
    db: () => getDb() as never,
    blobs: blobClient,
    executePrivileged: (contract: never, args: never) =>
      executePrivileged(contract as never, args as never) as never,
    invalidateQueries: () => {
      // No-op server-side. In the sandbox this invalidated the React Query
      // cache; the standalone client refetches explicitly after mutations.
    },
  };
}

// Action dispatch endpoint
// The client POSTs {action: "actionName", args: {...}}
app.post("/api/actions", async (req, res) => {
  const { action: actionName, args } = req.body ?? {};

  if (typeof actionName !== "string" || !actionName) {
    res.status(400).json({ ok: false, message: "Missing action name." });
    return;
  }

  const action = (Actions as Record<string, unknown>)[actionName];
  if (!isAction(action)) {
    res.status(404).json({ ok: false, message: `Unknown action: ${actionName}` });
    return;
  }

  try {
    // Validate request args with zod
    const parsedArgs = action.request.parse(args ?? {});

    // Call the handler with our standalone ctx
    const ctx = createCtx();
    const result = await action.handler(ctx, parsedArgs);

    // Validate response with zod (catches handler bugs in dev)
    const parsedResult = action.response.parse(result);
    res.json(parsedResult);
  } catch (error) {
    if (error && typeof error === "object" && "issues" in error) {
      // Zod validation error
      res.status(422).json({
        ok: false,
        message: "Invalid request.",
        issues: (error as { issues: unknown[] }).issues,
      });
      return;
    }
    console.error(`Action "${actionName}" failed:`, error);
    res.status(500).json({
      ok: false,
      message: error instanceof Error ? error.message : "Action failed.",
    });
  }
});

// Health check
app.get("/api/health", (_req, res) => {
  res.json({ ok: true, app: "orginsights-app", time: new Date().toISOString() });
});

// Blob serving (question images, uploads)
app.get("/blobs/*", async (req, res) => {
  try {
    const key = decodeURIComponent((req.params as string[])[0] ?? "");
    if (!key) {
      res.status(404).send("Not found");
      return;
    }
    const filePath = getBlobPath(key);
    if (!existsSync(filePath)) {
      res.status(404).send("Not found");
      return;
    }
    const mimeType = await getBlobMimeType(key);
    res.setHeader("Content-Type", mimeType);
    res.setHeader("Cache-Control", "public, max-age=86400");
    res.sendFile(filePath);
  } catch {
    res.status(404).send("Not found");
  }
});

// Serve the built React client
const clientDist = join(__dirname, "..", "..", "client", "dist");
if (existsSync(clientDist)) {
  app.use(express.static(clientDist));
  // SPA fallback: all non-API routes serve index.html
  app.get("*", (_req, res) => {
    res.sendFile(join(clientDist, "index.html"));
  });
} else {
  app.get("/", (_req, res) => {
    res.status(503).send(
      "Client not built. Run <code>npm run build:client</code> first."
    );
  });
}

// Graceful shutdown
process.on("SIGTERM", () => {
  console.log("Shutting down...");
  closeDb();
  process.exit(0);
});
process.on("SIGINT", () => {
  closeDb();
  process.exit(0);
});

// Startup seed: ensure admin user and default referral codes exist.
// This runs on every boot but only inserts missing rows (idempotent).
async function seedDefaults() {
  try {
    const { getDb } = await import("./db.js");
    const s = await import("../src/schema.js");
    const { eq } = await import("drizzle-orm");
    const db: any = getDb();

    // 1. Admin user
    const adminEmail = "akeel.mohamed@orgpath.io";
    const existingAdmin = await db.select().from(s.profiles).where(eq(s.profiles.email, adminEmail)).limit(1);
    if (!existingAdmin[0]) {
      const now = new Date();
      await db.insert(s.profiles).values({
        firstName: "Akeel",
        lastName: "Mohamed",
        email: adminEmail,
        country: "Canada",
        plan: "coaching",
        passwordHash: null,
        passwordUpdatedAt: null,
        coachDisclosure: false,
        isAdmin: true,
        createdAt: now,
      });
      console.log(`[seed] Created admin user ${adminEmail} (no password set; use Forgot Password to set one)`);
    } else if (!existingAdmin[0].isAdmin) {
      await db.update(s.profiles).set({ isAdmin: true }).where(eq(s.profiles.email, adminEmail));
      console.log(`[seed] Promoted ${adminEmail} to admin`);
    }

    // 2. Default referral codes
    const codes = [
      { code: "COACHFREE", ownerType: "coach", ownerName: "OrgInsights Coach Program", ownerEmail: null, discountPercent: 100, isCoachCode: true, pricingMode: "free", fixedPrice: null, unlockTier: "360", active: true },
      { code: "COACH25", ownerType: "coach", ownerName: "OrgInsights Coach Program", ownerEmail: null, discountPercent: 25, isCoachCode: true, pricingMode: "discount", fixedPrice: null, unlockTier: "360", active: true },
      { code: "UPGRADE25", ownerType: "organization", ownerName: "OrgInsights", ownerEmail: null, discountPercent: 25, isCoachCode: false, pricingMode: "discount", fixedPrice: null, unlockTier: "full", active: true },
      { code: "UPGRADE50", ownerType: "organization", ownerName: "OrgInsights", ownerEmail: null, discountPercent: 50, isCoachCode: false, pricingMode: "discount", fixedPrice: null, unlockTier: "full", active: true },
    ];
    for (const c of codes) {
      const existing = await db.select().from(s.referralCodes).where(eq(s.referralCodes.code, c.code)).limit(1);
      if (!existing[0]) {
        await db.insert(s.referralCodes).values({ ...c, createdAt: new Date() });
        console.log(`[seed] Created referral code ${c.code}`);
      }
    }
  } catch (err) {
    console.error("[seed] Startup seed failed (non-fatal):", err);
  }
}

app.listen(PORT, "0.0.0.0", async () => {
  console.log(`OrgInsights server running on http://0.0.0.0:${PORT}`);
  console.log(`Actions endpoint: POST /api/actions`);
  console.log(`Database: ${process.env.DATABASE_PATH || "./data/app.db"}`);
  await seedDefaults();
});
