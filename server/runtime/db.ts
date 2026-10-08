/**
 * Database setup: Drizzle ORM + Bun's built-in SQLite.
 *
 * Provides the same interface the app expects from ctx.db().
 * Database file location is configurable via DATABASE_PATH env var.
 */

import { Database } from "bun:sqlite";
import { drizzle } from "drizzle-orm/bun-sqlite";
import * as schema from "../src/schema";
import { existsSync, mkdirSync } from "node:fs";
import { dirname } from "node:path";

const dbPath = process.env.DATABASE_PATH || "./data/app.db";

// Ensure the data directory exists
const dir = dirname(dbPath);
if (!existsSync(dir)) {
  mkdirSync(dir, { recursive: true });
}

const sqlite = new Database(dbPath, { create: true });
// Enable WAL mode for better concurrent read performance
sqlite.exec("PRAGMA journal_mode = WAL;");
// Foreign keys for data integrity
sqlite.exec("PRAGMA foreign_keys = ON;");

export const db = drizzle(sqlite, { schema });
export type Db = typeof db;

// For ctx.db() compatibility - returns the drizzle instance
export function getDb(): Db {
  return db;
}

// Raw sqlite instance for migrations
export function getSqlite(): Database {
  return sqlite;
}

// Graceful shutdown
export function closeDb() {
  sqlite.close();
}
