import { defineConfig } from "drizzle-kit";

export default defineConfig({
  schema: "./server/src/schema-pg.ts",
  out: "./drizzle-pg",
  dialect: "postgresql",
});
