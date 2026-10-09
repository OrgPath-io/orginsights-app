/**
 * PostgreSQL migration runner.
 *
 * Applies SQL migrations in drizzle-pg/ to the PostgreSQL database
 * specified by DATABASE_URL. Tracks applied migrations for idempotency.
 *
 * Run: npm run db:migrate:pg
 */

import { readdirSync, readFileSync } from "node:fs";
import { join, dirname } from "node:path";
import { fileURLToPath } from "node:url";
import { Pool } from "pg";

const databaseUrl = process.env.DATABASE_URL;
if (!databaseUrl) {
  console.error("DATABASE_URL is not set");
  process.exit(1);
}

const migrationsDir = join(dirname(fileURLToPath(import.meta.url)), "..", "..", "drizzle-pg");

const pool = new Pool({
  connectionString: databaseUrl,
  ssl: { rejectUnauthorized: false },
});

const client = await pool.connect();

try {
  // Migration tracking table
  await client.query(`
    CREATE TABLE IF NOT EXISTS _migrations (
      id SERIAL PRIMARY KEY,
      name TEXT UNIQUE NOT NULL,
      applied_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
    )
  `);

  const { rows } = await client.query("SELECT name FROM _migrations");
  const applied = new Set(rows.map((r: any) => r.name));

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
      const statements = sql.split(/-->\s*statement-breakpoint/).join(";");
      await client.query(statements);
      await client.query("INSERT INTO _migrations (name) VALUES ($1)", [file]);
      appliedCount++;
      console.log(`  Applied: ${file}`);
    } catch (error) {
      console.error(`  FAILED: ${file}`);
      console.error(error);
      process.exit(1);
    }
  }

  console.log(`\nDone. ${appliedCount} new migration(s) applied, ${files.length} total.`);
} finally {
  client.release();
  await pool.end();
}
