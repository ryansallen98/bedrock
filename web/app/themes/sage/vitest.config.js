import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { defineConfig } from 'vitest/config';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

export default defineConfig({
  test: {
    environment: 'node',
    // Includes colocated tests and `**/__tests__/**` (e.g. `resources/ts/components/__tests__/*.test.ts`).
    include: ['resources/**/*.{test,spec}.{js,ts}'],
    exclude: ['node_modules', 'public/build', 'vendor'],
    passWithNoTests: false,
  },
  resolve: {
    alias: {
      '@scripts': path.resolve(__dirname, 'resources/ts'),
      '@styles': path.resolve(__dirname, 'resources/css'),
      '@fonts': path.resolve(__dirname, 'resources/fonts'),
      '@images': path.resolve(__dirname, 'resources/images'),
    },
  },
});
