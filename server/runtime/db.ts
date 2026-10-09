/**
 * Database setup: Drizzle ORM.
 *
 * Uses PostgreSQL (via DATABASE_URL) when available, otherwise falls back
 * to better-sqlite3 (local dev / legacy).
 */

import { existsSync, mkdirSync } from "node:fs";
import { dirname } from "node:path";

const databaseUrl = process.env.DATABASE_URL;

let db: any;
let closeDb: () => void;

if (databaseUrl) {
  // PostgreSQL (Heroku)
  const { Pool } = await import("pg");
  const { drizzle } = await import("drizzle-orm/node-postgres");
  const schema = await import("../src/schema-pg.js");

  const pool = new Pool({
    connectionString: databaseUrl,
    ssl: { rejectUnauthorized: false },
    max: 5,
  });

  const baseDb = drizzle(pool, { schema });

  // drizzle node-postgres has no .batch(), provide one for compatibility
  async function batch(queries: Array<PromiseLike<unknown>>): Promise<unknown[]> {
    const results: unknown[] = [];
    for (const q of queries) {
      results.push(await q);
    }
    return results;
  }

  db = Object.assign(baseDb, { batch });
  closeDb = () => {
    pool.end();
  };
  console.log("[db] Using PostgreSQL");
} else {
  // SQLite fallback (local dev)
  const Database = (await import("better-sqlite3")).default;
  const { drizzle } = await import("drizzle-orm/better-sqlite3");
  const schema = await import("../src/schema.js");

  const dbPath = process.env.DATABASE_PATH || "./data/app.db";
  const dir = dirname(dbPath);
  if (!existsSync(dir)) {
    mkdirSync(dir, { recursive: true });
  }

  const sqlite = new Database(dbPath);
  sqlite.pragma("journal_mode = WAL");
  sqlite.pragma("foreign_keys = ON");

  const baseDb = drizzle(sqlite, { schema });

  async function batch(queries: Array<PromiseLike<unknown>>): Promise<unknown[]> {
    const results: unknown[] = [];
    for (const q of queries) {
      results.push(await q);
    }
    return results;
  }

  db = Object.assign(baseDb, { batch });
  closeDb = () => {
    sqlite.close();
  };
  console.log(`[db] Using SQLite at ${process.env.DATABASE_PATH || "./data/app.db"}`);
}

export { db, closeDb };
export type Db = typeof db;

export function getDb(): Db {
  return db;
}
