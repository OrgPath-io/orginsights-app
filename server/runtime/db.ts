/**
 * Database setup: Drizzle ORM + better-sqlite3 (Node.js).
 *
 * Provides the same interface the app expects from ctx.db().
 * Database file location is configurable via DATABASE_PATH env var.
 */

import Database from "better-sqlite3";
import { drizzle } from "drizzle-orm/better-sqlite3";
import * as schema from "../src/schema";
import { existsSync, mkdirSync } from "node:fs";
import { dirname } from "node:path";

const dbPath = process.env.DATABASE_PATH || "./data/app.db";

// Ensure the data directory exists
const dir = dirname(dbPath);
if (!existsSync(dir)) {
  mkdirSync(dir, { recursive: true });
}

const sqlite = new Database(dbPath);
// Enable WAL mode for better concurrent read performance
sqlite.pragma("journal_mode = WAL");
// Foreign keys for data integrity
sqlite.pragma("foreign_keys = ON");

const baseDb = drizzle(sqlite, { schema });

// drizzle-orm's better-sqlite3 driver has no .batch() method, so we provide
// one: it runs the queued query builders sequentially in order and returns
// their results. (better-sqlite3 is synchronous, so ordering is guaranteed.)
async function batch(queries: Array<PromiseLike<unknown>>): Promise<unknown[]> {
  const results: unknown[] = [];
  for (const q of queries) {
    results.push(await q);
  }
  return results;
}

export const db = Object.assign(baseDb, { batch });
export type Db = typeof db;

// For ctx.db() compatibility - returns the drizzle instance
export function getDb(): Db {
  return db;
}

// Raw sqlite instance for migrations
export function getSqlite() {
  return sqlite;
}

// Graceful shutdown
export function closeDb() {
  sqlite.close();
}
