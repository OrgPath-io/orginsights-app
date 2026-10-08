/**
 * Filesystem-based blob storage replacing ctx.blobs.
 *
 * Used for question images and other uploaded files.
 * Files are stored under BLOB_DIR (default ./data/blobs) and served
 * via the /blobs/:key HTTP endpoint.
 */

import { existsSync, mkdirSync } from "node:fs";
import { readFile, writeFile, unlink } from "node:fs/promises";
import { join, dirname } from "node:path";
import type { BlobClient } from "./shim";

const blobDir = process.env.BLOB_DIR || "./data/blobs";

if (!existsSync(blobDir)) {
  mkdirSync(blobDir, { recursive: true });
}

// Sanitize keys to prevent path traversal
function safePath(key: string): string {
  const sanitized = key.replace(/[^a-zA-Z0-9\-_./]/g, "_");
  const fullPath = join(blobDir, sanitized);
  // Ensure the resolved path stays within blobDir
  const resolved = join(process.cwd(), fullPath);
  const base = join(process.cwd(), blobDir);
  if (!resolved.startsWith(base)) {
    throw new Error("Invalid blob key");
  }
  return fullPath;
}

// MIME type storage (sidecar files)
async function getMimeType(key: string): Promise<string | null> {
  try {
    const data = await readFile(safePath(key) + ".mime", "utf8");
    return data.trim();
  } catch {
    return null;
  }
}

export const blobClient: BlobClient = {
  async put(key: string, data: Uint8Array, opts?: { contentType?: string }): Promise<void> {
    const path = safePath(key);
    const dir = dirname(path);
    if (!existsSync(dir)) {
      mkdirSync(dir, { recursive: true });
    }
    await writeFile(path, data);
    if (opts?.contentType) {
      await writeFile(path + ".mime", opts.contentType);
    }
  },

  async getUrl(key: string): Promise<string | null> {
    if (!existsSync(safePath(key))) return null;
    // Return relative URL - the Express server serves /blobs/*
    return `/blobs/${encodeURIComponent(key)}`;
  },

  async get(key: string): Promise<Uint8Array | null> {
    try {
      const data = await readFile(safePath(key));
      return new Uint8Array(data);
    } catch {
      return null;
    }
  },

  async delete(key: string): Promise<void> {
    const path = safePath(key);
    try {
      await unlink(path);
    } catch {
      // Already gone
    }
    try {
      await unlink(path + ".mime");
    } catch {
      // No mime file
    }
  },
};

export async function getBlobMimeType(key: string): Promise<string> {
  return (await getMimeType(key)) || "application/octet-stream";
}

export function getBlobPath(key: string): string {
  return safePath(key);
}
