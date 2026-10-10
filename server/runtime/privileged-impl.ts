/**
 * Direct privileged operation implementations.
 *
 * Replaces the SDK's privileged transport with direct function calls.
 * - PDF rendering: headless Chromium (same implementation as original)
 * - SMTP: nodemailer (same implementation as original)
 * - Legacy SMTP config: reads from env vars instead of the original PHP file
 */

import { existsSync } from "node:fs";
import { readFile, rm } from "node:fs/promises";
import { spawn, type ChildProcess } from "node:child_process";
import nodemailer from "nodemailer";
import Stripe from "stripe";
import { renderOriginalReportHtml, type TemplateInput } from "../src/report-template";
import type { PrivilegedContract } from "./shim";
import { z } from "zod";

// Contract definitions (mirrors server/src/privileged.ts)
export const privilegedContracts = {
  renderReportPdf: {
    request: z.object({ templateInput: z.any() }),
    response: z.object({ pdfBase64: z.string().min(1), renderer: z.string() }),
    timeoutMs: 120000,
    __contractName: "renderReportPdf" as const,
  },
  renderHtmlPdf: {
    request: z.object({ html: z.string().min(1) }),
    response: z.object({ pdfBase64: z.string().min(1), renderer: z.string() }),
    timeoutMs: 120000,
    __contractName: "renderHtmlPdf" as const,
  },
  loadLegacySmtpConfiguration: {
    request: z.object({}),
    response: z.object({
      found: z.boolean(), host: z.string(), user: z.string(),
      password: z.string(), port: z.number().int(),
      fromEmail: z.string(), fromName: z.string()
    }),
    __contractName: "loadLegacySmtpConfiguration" as const,
  },
  sendSmtpMail: {
    request: z.object({
      host: z.string().min(1), user: z.string().min(1), password: z.string().min(1),
      port: z.number().int().min(1).max(65535),
      fromEmail: z.string().email(), fromName: z.string().min(1),
      to: z.string().email(), subject: z.string().min(1), html: z.string().min(1)
    }),
    response: z.object({
      ok: z.boolean(), usedPort: z.number().int(),
      messageId: z.string().optional(), error: z.string().optional()
    }),
    timeoutMs: 30000,
    __contractName: "sendSmtpMail" as const,
  },
  createStripeCheckoutSession: {
    request: z.object({
      amountCents: z.number().int().positive(),
      productName: z.string().min(1),
      profileId: z.number().int().positive(),
      item: z.enum(["full", "360", "coaching", "additional_coaching"]),
      discountCode: z.string().nullable(),
      customerEmail: z.string().email(),
      successUrl: z.string().url(),
      cancelUrl: z.string().url(),
    }),
    response: z.object({ id: z.string().min(1), url: z.string().url() }),
    timeoutMs: 30000,
    __contractName: "createStripeCheckoutSession" as const,
  },
  verifyStripeCheckoutWebhook: {
    request: z.object({ payload: z.string().min(1), signature: z.string().min(1) }),
    response: z.object({
      handled: z.boolean(),
      sessionId: z.string().nullable(),
      paymentStatus: z.string().nullable(),
      profileId: z.number().int().positive().nullable(),
      item: z.enum(["full", "360", "coaching", "additional_coaching"]).nullable(),
      discountCode: z.string().nullable(),
      subtotalCents: z.number().int().nonnegative(),
      taxCents: z.number().int().nonnegative(),
      totalCents: z.number().int().nonnegative(),
      customerCountry: z.string().nullable(),
      taxRate: z.number().nonnegative().nullable(),
      taxLabel: z.string().nullable(),
    }),
    timeoutMs: 30000,
    __contractName: "verifyStripeCheckoutWebhook" as const,
  },
};

type CdpReply = { id?: number; result?: unknown; error?: { message?: string } };

async function renderWithChromium(html: string): Promise<string> {
  // Use @sparticuz/chromium (serverless-optimized) if available, then Puppeteer, then system paths
  let chrome: string | undefined;
  try {
    const chromium = await import("@sparticuz/chromium");
    chrome = await chromium.default.executablePath();
    if (chrome && !existsSync(chrome)) chrome = undefined;
  } catch {
    // @sparticuz/chromium not available
  }
  if (!chrome) {
    try {
      const puppeteer = await import("puppeteer");
      chrome = puppeteer.executablePath();
      if (chrome && !existsSync(chrome)) chrome = undefined;
    } catch {
      // Puppeteer not available
    }
  }
  if (!chrome) {
    chrome = [
      process.env.CHROME_PATH,
      "/opt/meta-chromium/chrome",
      "/usr/bin/chromium",
      "/usr/bin/chromium-browser",
      "/usr/bin/google-chrome",
      "/usr/bin/google-chrome-stable",
      "/snap/bin/chromium",
    ].filter(Boolean).find((p) => p && existsSync(p));
  }

  if (!chrome) {
    throw new Error(
      "Headless Chromium is not installed. " +
      "Set CHROME_PATH env var or install chromium. " +
      "PDF generation requires a Chromium binary."
    );
  }

  const profileDir = `/tmp/orginsights-pdf-${crypto.randomUUID()}`;
  const proc: ChildProcess = spawn(
    chrome,
    ["--headless=new", "--no-sandbox", "--disable-gpu",
      "--disable-dev-shm-usage", "--disable-background-networking",
      "--no-first-run", "--remote-debugging-port=0",
      `--user-data-dir=${profileDir}`, "about:blank"],
    { stdio: "ignore" }
  );

  const sleep = (ms: number) => new Promise<void>((resolve) => setTimeout(resolve, ms));

  let socket: WebSocket | null = null;
  try {
    let socketUrl = "";
    for (let attempt = 0; attempt < 150; attempt += 1) {
      try {
        const [port = "", path = ""] = (await readFile(`${profileDir}/DevToolsActivePort`, "utf8")).trim().split("\n");
        if (port && path) { socketUrl = `ws://127.0.0.1:${port}${path}`; break; }
      } catch {
        // Chromium needs a short startup window before DevTools is ready.
      }
      await sleep(100);
    }
    if (!socketUrl) throw new Error("Headless Chromium started but its print interface was unavailable.");

    socket = new WebSocket(socketUrl);
    await new Promise<void>((resolve, reject) => {
      const timer = setTimeout(() => reject(new Error("Chromium DevTools did not open.")), 10000);
      socket?.addEventListener("open", () => { clearTimeout(timer); resolve(); }, { once: true });
      socket?.addEventListener("error", () => { clearTimeout(timer); reject(new Error("Chromium DevTools connection failed.")); }, { once: true });
    });

    let nextId = 0;
    const pending = new Map<number, { resolve: (value: unknown) => void; reject: (reason: Error) => void }>();
    socket.addEventListener("message", (event) => {
      const reply = JSON.parse(String(event.data)) as CdpReply;
      if (reply.id === undefined) return;
      const waiter = pending.get(reply.id);
      if (!waiter) return;
      pending.delete(reply.id);
      if (reply.error) waiter.reject(new Error(reply.error.message ?? "Chromium command failed."));
      else waiter.resolve(reply.result);
    });

    const send = <T>(method: string, params: Record<string, unknown> = {}, sessionId?: string) =>
      new Promise<T>((resolve, reject) => {
        const id = ++nextId;
        pending.set(id, { resolve: (value) => resolve(value as T), reject });
        socket?.send(JSON.stringify({ id, method, params, ...(sessionId ? { sessionId } : {}) }));
      });

    const target = await send<{ targetId: string }>("Target.createTarget", { url: "about:blank" });
    const attached = await send<{ sessionId: string }>("Target.attachToTarget", { targetId: target.targetId, flatten: true });
    await send("Page.enable", {}, attached.sessionId);
    const tree = await send<{ frameTree: { frame: { id: string } } }>("Page.getFrameTree", {}, attached.sessionId);
    await send("Page.setDocumentContent", { frameId: tree.frameTree.frame.id, html }, attached.sessionId);
    await send("Runtime.evaluate", {
      expression: "document.fonts.ready.then(() => new Promise(resolve => requestAnimationFrame(() => requestAnimationFrame(resolve))))",
      awaitPromise: true, returnByValue: true
    }, attached.sessionId);
    const result = await send<{ data: string }>("Page.printToPDF", {
      printBackground: true, preferCSSPageSize: true,
      paperWidth: 8.2677, paperHeight: 11.6929,
      marginTop: 0, marginBottom: 0, marginLeft: 0, marginRight: 0
    }, attached.sessionId);

    if (!result.data.startsWith("JVBER")) throw new Error("Chromium did not return a valid PDF document.");
    return result.data;
  } finally {
    socket?.close();
    try {
      proc.kill();
    } catch {
      // Process may have already exited.
    }
    // Wait for the Chromium process to exit (with a timeout so we never hang).
    await new Promise<void>((resolve) => {
      if (proc.exitCode !== null || proc.signalCode !== null) {
        resolve();
        return;
      }
      const timer = setTimeout(resolve, 5000);
      proc.once("exit", () => {
        clearTimeout(timer);
        resolve();
      });
    });
    await rm(profileDir, { recursive: true, force: true }).catch(() => undefined);
  }
}

// Direct executor - no SDK transport needed
function stripeClient() {
  const secretKey = process.env.STRIPE_SECRET_KEY?.trim();
  if (!secretKey) throw new Error("Stripe is not configured. Add STRIPE_SECRET_KEY to the server environment.");
  return new Stripe(secretKey);
}

export async function executePrivileged<C extends PrivilegedContract>(
  contract: C,
  args: z.infer<C["request"]>
): Promise<z.infer<C["response"]>> {
  const name = (contract as { __contractName?: string }).__contractName;

  switch (name) {
    case "renderReportPdf": {
      const { templateInput } = args as { templateInput: TemplateInput };
      const html = renderOriginalReportHtml(templateInput);
      const pdfBase64 = await renderWithChromium(html);
      return { pdfBase64, renderer: "Chromium HTML-to-PDF" } as z.infer<C["response"]>;
    }

    case "renderHtmlPdf": {
      const { html } = args as { html: string };
      const pdfBase64 = await renderWithChromium(html);
      return { pdfBase64, renderer: "Chromium HTML-to-PDF" } as z.infer<C["response"]>;
    }

    case "loadLegacySmtpConfiguration": {
      // In standalone mode, read from environment variables
      // (original read from a PHP config file that won't exist on Replit)
      const host = process.env.SMTP_HOST || "";
      const user = process.env.SMTP_USER || "";
      const password = process.env.SMTP_PASSWORD || "";
      if (!host || !user || !password) {
        return {
          found: false, host: "", user: "", password: "",
          port: 587, fromEmail: "info@orginsights.io", fromName: "OrgInsights"
        } as z.infer<C["response"]>;
      }
      return {
        found: true, host, user, password, port: 587,
        fromEmail: process.env.SMTP_FROM_EMAIL || "info@orginsights.io",
        fromName: process.env.SMTP_FROM_NAME || "OrgInsights",
      } as z.infer<C["response"]>;
    }

    case "sendSmtpMail": {
      const mailArgs = args as {
        host: string; user: string; password: string; port: number;
        fromEmail: string; fromName: string; to: string;
        subject: string; html: string;
      };
      const port = 587;
      try {
        const transport = nodemailer.createTransport({
          host: mailArgs.host, port, secure: false, requireTLS: true,
          auth: { user: mailArgs.user, pass: mailArgs.password },
          connectionTimeout: 10000, greetingTimeout: 10000, socketTimeout: 20000,
        });
        const sent = await transport.sendMail({
          from: { address: mailArgs.fromEmail, name: mailArgs.fromName },
          to: mailArgs.to, subject: mailArgs.subject, html: mailArgs.html,
        });
        return { ok: true, usedPort: port, messageId: sent.messageId } as z.infer<C["response"]>;
      } catch (error) {
        const smtpError = error as { message?: unknown; code?: unknown; command?: unknown; responseCode?: unknown };
        const message = typeof smtpError.message === "string" ? smtpError.message : "SMTP connection failed.";
        const details = [
          typeof smtpError.code === "string" ? `code ${smtpError.code}` : "",
          typeof smtpError.command === "string" ? `command ${smtpError.command}` : "",
          typeof smtpError.responseCode === "number" ? `response ${smtpError.responseCode}` : "",
        ].filter(Boolean).join(", ");
        const raw = details ? `${message} (${details})` : message;
        const redacted = [mailArgs.password, mailArgs.user]
          .filter(Boolean)
          .reduce((value, secret) => value.split(secret).join("[redacted]"), raw);
        return { ok: false, usedPort: port, error: redacted.slice(0, 480) } as z.infer<C["response"]>;
      }
    }

    case "createStripeCheckoutSession": {
      const stripeArgs = args as {
        amountCents: number; productName: string; profileId: number;
        item: "full" | "360" | "coaching" | "additional_coaching";
        discountCode: string | null; customerEmail: string;
        successUrl: string; cancelUrl: string;
      };
      const stripe = stripeClient();
      const session = await stripe.checkout.sessions.create({
        mode: "payment",
        billing_address_collection: "required",
        automatic_tax: { enabled: true },
        customer_email: stripeArgs.customerEmail,
        customer_creation: "always",
        line_items: [{
          quantity: 1,
          price_data: {
            currency: "usd",
            unit_amount: stripeArgs.amountCents,
            product_data: { name: stripeArgs.productName },
          },
        }],
        metadata: {
          profileId: String(stripeArgs.profileId),
          item: stripeArgs.item,
          discountCode: stripeArgs.discountCode ?? "",
        },
        payment_intent_data: {
          receipt_email: stripeArgs.customerEmail,
          metadata: {
            profileId: String(stripeArgs.profileId),
            item: stripeArgs.item,
            discountCode: stripeArgs.discountCode ?? "",
          },
        },
        invoice_creation: {
          enabled: true,
          invoice_data: {
            description: `${stripeArgs.productName} from Orgpath Inc.`,
            custom_fields: [
              { name: "Business", value: "Orgpath Inc." },
              { name: "HST #", value: "721336477RT0001" },
            ],
            footer: "Canadian GST/HST is charged on top according to the billing province. No tax is added outside Canada.",
          },
        },
        success_url: stripeArgs.successUrl,
        cancel_url: stripeArgs.cancelUrl,
      });
      if (!session.url) throw new Error("Stripe created the Checkout Session without a redirect URL.");
      return { id: session.id, url: session.url } as z.infer<C["response"]>;
    }

    case "verifyStripeCheckoutWebhook": {
      const webhookArgs = args as { payload: string; signature: string };
      const webhookSecret = process.env.STRIPE_WEBHOOK_SECRET?.trim();
      if (!webhookSecret) throw new Error("Stripe webhooks are not configured. Add STRIPE_WEBHOOK_SECRET to the server environment.");
      const stripe = stripeClient();
      const event = stripe.webhooks.constructEvent(webhookArgs.payload, webhookArgs.signature, webhookSecret);
      if (event.type !== "checkout.session.completed") {
        return { handled: false, sessionId: null, paymentStatus: null, profileId: null, item: null, discountCode: null, subtotalCents: 0, taxCents: 0, totalCents: 0, customerCountry: null, taxRate: null, taxLabel: null } as z.infer<C["response"]>;
      }
      const session = event.data.object;
      const metadata = session.metadata ?? {};
      const profileId = Number(metadata.profileId);
      const item = metadata.item;
      if (!Number.isInteger(profileId) || profileId <= 0 || !["full", "360", "coaching", "additional_coaching"].includes(item ?? "")) {
        throw new Error("The completed Stripe session is missing valid purchase metadata.");
      }
      const tax = session.total_details?.breakdown?.taxes?.[0];
      return {
        handled: true,
        sessionId: session.id,
        paymentStatus: session.payment_status,
        profileId,
        item,
        discountCode: metadata.discountCode || null,
        subtotalCents: session.amount_subtotal ?? 0,
        taxCents: session.total_details?.amount_tax ?? 0,
        totalCents: session.amount_total ?? 0,
        customerCountry: session.customer_details?.address?.country ?? null,
        taxRate: tax?.rate?.percentage ?? null,
        taxLabel: tax?.rate?.display_name ?? null,
      } as z.infer<C["response"]>;
    }

    default:
      throw new Error(`Unknown privileged contract: ${String(name)}`);
  }
}
