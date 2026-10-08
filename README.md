# OrgInsights App - Standalone Deployment

Fullstack TypeScript assessment platform. This is a standalone build that runs
outside the Hatch sandbox on any Node/Bun-compatible host (Replit, VPS, etc.).

## Quick Start

```bash
# Install dependencies
bun install

# Start (runs migrations, then the server)
bun run start
```

The app will be available at `http://localhost:5000`.

## Scripts

| Command | Description |
|---------|-------------|
| `bun run start` | Run migrations + start server (production) |
| `bun run dev` | Start server with hot reload (development) |
| `bun run build` | Build the React client |
| `bun run db:migrate` | Apply database migrations only |
| `bun run typecheck` | Type-check client and server |

## Environment Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `PORT` | `5000` | HTTP port |
| `DATABASE_PATH` | `./data/app.db` | SQLite database file |
| `BLOB_DIR` | `./data/blobs` | Uploaded files (question images) |
| `SMTP_HOST` | - | SMTP server for emails |
| `SMTP_USER` | - | SMTP username |
| `SMTP_PASSWORD` | - | SMTP password |
| `SMTP_FROM_EMAIL` | `info@orginsights.io` | From address |
| `SMTP_FROM_NAME` | `OrgInsights` | From name |
| `CHROME_PATH` | auto-detect | Path to Chromium for PDF generation |

## Architecture

```
client/          React frontend (built to client/dist/)
server/
  src/           App logic (actions.ts, schema.ts) - UNCHANGED from original
  runtime/       Standalone runtime (NEW for this deployment)
    shim.ts          Replaces @hatch/space-sdk (defineAction, Ctx, z)
    db.ts            Drizzle + Bun SQLite
    blobs.ts         Filesystem blob storage
    privileged-impl.ts  PDF rendering + SMTP (direct, no SDK)
    server.ts        Express server
    migrate.ts       Database migration runner
drizzle/         20 SQL migrations (schema + seed data)
data/            Runtime data (gitignored): app.db, blobs/
```

### How it works

The original app was built for the Hatch sandbox runtime. This standalone
version replaces the sandbox with:

1. **Action RPC** (`server/runtime/server.ts`): Express server exposing
   `POST /api/actions`. The client sends `{action: "name", args: {...}}`,
   the server validates with Zod, runs the handler, returns the result.
   All 63 actions work unchanged.

2. **Database** (`server/runtime/db.ts`): Drizzle ORM with Bun's built-in
   SQLite. Same schema, same queries. Migrations in `drizzle/` apply
   cleanly to a fresh database (includes all seed data: 139 questions,
   23 capabilities, 707 LinkedIn courses, etc.).

3. **Blob storage** (`server/runtime/blobs.ts`): Filesystem-based,
   served via `/blobs/*`. Replaces the sandbox blob API.

4. **Privileged ops** (`server/runtime/privileged-impl.ts`):
   - PDF generation via headless Chromium (same implementation)
   - SMTP via nodemailer (same implementation)
   - Legacy SMTP config now reads from env vars

5. **Client** (`client/src/api.ts`): Fetch-based RPC client replacing
   the SDK's `createActionClient`. Same typed interface.

### What changed vs the original

**Infrastructure only** - no app logic was modified:
- `server/src/actions.ts`: import lines only (SDK → shim)
- `client/src/api.ts`: rewritten (fetch instead of SDK)
- `client/src/main.tsx`: local QueryClient instead of SDK's
- `client/src/App.tsx`: local SafeAreaTopScrim component
- `client/build.mjs`: direct Bun.build() instead of SDK wrapper
- `package.json`: removed @hatch/space-sdk, added express

One bug fix during migration: a raw SQL query passed a `Date` object
directly as a binding parameter (line 734). Changed to `.getTime()` for
bun:sqlite compatibility. This was a latent bug that the original
runtime happened to tolerate.

## Replit Deployment

1. Create a new Replit project, import from GitHub (or upload this folder)
2. Set the Run command to `bun run start`
3. Add secrets for `SMTP_HOST`, `SMTP_USER`, `SMTP_PASSWORD`
4. For PDF generation, add Chromium: Replit's Nix environment can install it,
   or set `CHROME_PATH` to a pre-installed binary
5. Configure custom domain in Replit's deployment settings

## Stripe (Test Mode)

Stripe integration is not yet implemented. When ready:
1. Add `stripe` npm package
2. Implement checkout using Stripe test keys
3. Test with card `4242 4242 4242 4242`
4. Swap to live keys at go-live (config change only)
