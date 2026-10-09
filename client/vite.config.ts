import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import { fileURLToPath } from "node:url";
import { dirname, join } from "node:path";

const clientDir = dirname(fileURLToPath(import.meta.url));

// Client build for standalone (Node.js) deployment.
// Bundles client/index.html to client/dist/.
// Replaces the previous Bun.build-based client/build.mjs.
export default defineConfig({
  root: clientDir,
  // Relative asset URLs so the build works behind any base path.
  base: "./",
  plugins: [tailwindcss()],
  build: {
    outDir: join(clientDir, "dist"),
    emptyOutDir: true,
  },
});
