---
name: linting-php-eslint
description: >-
  Mandatory Laravel Pint for theme PHP and ESLint for theme TypeScript/JavaScript:
  composer lint, npm lint, eslint.config.js, CI and root test:theme gates.
---

# Linting (Pint + ESLint)

**Rules:** `.cursor/rules/13-mandatory-lint.mdc`, **`11-frontend-formatting.mdc`** (Prettier; **`eslint-config-prettier`** avoids overlap).

## Theme working directory

```bash
cd web/app/themes/{THEME_SLUG}
```

Current template: `sage`.

## PHP — Laravel Pint

| Command | Purpose |
|---------|---------|
| `composer run lint` | Pint **`--test`** — CI and **`npm run test:theme`** run this. |
| `composer run lint:fix` | Apply Pint fixes after editing theme PHP. |

Pint covers theme **`app/`**, root **`*.php`** (e.g. `functions.php`, `block.php`, `flexible.php`), **`config/`**, **`tests/**/*.php`**, etc. **Blade** (`.blade.php`) is not Prettier-formatted; PHP style in `.php` files is still Pint.

## TypeScript / JavaScript — ESLint

| Command | Purpose |
|---------|---------|
| `npm run lint:eslint` | ESLint over configured paths only. |
| `npm run lint:eslint:fix` | ESLint with **`--fix`**. |
| `npm run lint` | **ESLint** then **`npm run format:check`** — use before merge when TS/JS or Prettier-scoped assets changed. |
| `npm run lint:fix` | ESLint fix + **`npm run format`** (Prettier write). |

**Config:** **`eslint.config.js`** at theme root (flat config). **Node** globals for **`vite.config.js`**, **`vitest.config.js`**, **`vite.plugins/**`**; **browser** globals for **`resources/ts/**`** and **`env.d.ts`**. Ignores **`vendor/`**, **`public/`**, **`resources/views/`**, **`app/`** (PHP), **`tests/`** (PHP PHPUnit tree).

## Bedrock root

- **`npm run test:theme`**: runs theme **`composer run lint`**, **`composer test`**, **`npm run lint`**, **`npm run test`**, **`npm run typecheck`**.
- Root **`composer run lint`**: Pint for Bedrock-managed PHP when you change files outside the theme (see **`bedrock-sage`**).

## Done checklist (theme)

1. `composer run lint` (or `lint:fix` then `lint`) when PHP changed
2. `npm run lint` (or `lint:fix` then `lint`) when TS/JS or covered assets changed
3. Continue with **`testing-php-vitest`** (`composer test`, `npm run test`, `npm run typecheck`, `npm run build`)

**CI:** `.github/workflows/theme-tests.yml` runs Pint and **`npm run lint`**.
