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
};

type CdpReply = { id?: number; result?: unknown; error?: { message?: string } };

async function renderWithChromium(html: string): Promise<string> {
  // Use Puppeteer's bundled Chromium if available, fallback to system paths
  let chrome: string | undefined;
  try {
    const puppeteer = await import("puppeteer");
    chrome = puppeteer.executablePath();
    if (chrome && !existsSync(chrome)) chrome = undefined;
  } catch {
    // Puppeteer not available, try system paths
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

    default:
      throw new Error(`Unknown privileged contract: ${String(name)}`);
  }
}
