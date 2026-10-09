/**
 * Database migration runner.
 *
 * Applies all SQL migrations in drizzle/ to a fresh SQLite database,
 * in filename order. Tracks applied migrations in a _migrations table
 * so re-runs are safe (idempotent).
 *
 * Run: npm run db:migrate
 */

import Database from "better-sqlite3";
import { readdirSync, readFileSync, existsSync, mkdirSync } from "node:fs";
import { join, dirname } from "node:path";
import { fileURLToPath } from "node:url";

const dbPath = process.env.DATABASE_PATH || "./data/app.db";
const migrationsDir = join(dirname(fileURLToPath(import.meta.url)), "..", "..", "drizzle");

// Ensure data directory exists
const dir = dirname(dbPath);
if (!existsSync(dir)) {
  mkdirSync(dir, { recursive: true });
}

const db = new Database(dbPath);
db.pragma("journal_mode = WAL");
db.pragma("foreign_keys = ON");

// Migration tracking table
db.exec(`
  CREATE TABLE IF NOT EXISTS _migrations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL,
    applied_at INTEGER NOT NULL
  )
`);

const applied = new Set(
  (db.prepare("SELECT name FROM _migrations").all() as { name: string }[]).map((r) => r.name)
);

// Get migration files in order
const files = readdirSync(migrationsDir)
  .filter((f) => f.endsWith(".sql"))
  .sort();

let appliedCount = 0;
for (const file of files) {
  if (applied.has(file)) {
    console.log(`  Skipped (already applied): ${file}`);
    continue;
  }

  console.log(`  Applying: ${file}`);
  const sql = readFileSync(join(migrationsDir, file), "utf8");

  try {
    // Drizzle uses --> statement-breakpoint as a separator
    const statements = sql.split(/-->\s*statement-breakpoint/).join(";");
    db.exec(statements);
    db.prepare("INSERT INTO _migrations (name, applied_at) VALUES (?, ?)").run(file, Date.now());
    appliedCount++;
    console.log(`  Applied: ${file}`);
  } catch (error) {
    console.error(`  FAILED: ${file}`);
    console.error(error);
    process.exit(1);
  }
}

console.log(`\nDone. ${appliedCount} new migration(s) applied, ${files.length} total.`);
db.close();
