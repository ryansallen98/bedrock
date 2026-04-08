import eslint from '@eslint/js';
import eslintConfigPrettier from 'eslint-config-prettier/flat';
import globals from 'globals';
import tseslint from 'typescript-eslint';

export default tseslint.config(
  {
    ignores: [
      'node_modules/**',
      'vendor/**',
      'public/**',
      'resources/views/**',
      'app/**',
      'tests/**',
      '*.php',
      'resources/lang/**',
    ],
  },
  eslint.configs.recommended,
  ...tseslint.configs.recommended,
  eslintConfigPrettier,
  {
    files: ['vite.config.js', 'vitest.config.js', 'vite.plugins/**/*.js'],
    languageOptions: {
      globals: globals.node,
    },
  },
  {
    files: ['resources/ts/**/*.ts', 'env.d.ts'],
    languageOptions: {
      globals: globals.browser,
    },
  }
);
