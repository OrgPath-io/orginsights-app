/**
 * Schema selector: exports the PostgreSQL schema when DATABASE_URL is set,
 * otherwise the SQLite schema. Both schemas export identical table/column names.
 */
export * from "./schema-pg.js";
