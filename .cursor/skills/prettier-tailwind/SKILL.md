---
name: prettier-tailwind
description: >-
  Mandatory Prettier + prettier-plugin-tailwindcss for the Sage theme: what is
  formatted, what is excluded (Blade/PHP), EditorConfig alignment, npm scripts.
---

# Prettier + Tailwind (Sage theme)

**Rule:** `.cursor/rules/11-frontend-formatting.mdc`.

## Working directory

```bash
cd web/app/themes/{THEME_SLUG}
```

## Commands

| Script | Use |
|--------|-----|
| `npm run format` | Apply Prettier to allowed paths (see `.prettierignore`). |
| `npm run format:check` | CI / before merge — must pass if you touched covered files. |
| `npm run lint` | Runs **ESLint** then **`format:check`** — preferred single gate (**`13-mandatory-lint.mdc`**, skill **`linting-php-eslint`**). |

Bedrock root: **`npm run format:theme`** → theme `format:check`.

## What Prettier owns

- **`resources/ts/**`**, **`resources/css/**`**, theme **`*.config.js`**, **`env.d.ts`**, **`tsconfig.json`**, **`theme.json`**, **`package.json`**, **`composer.json`** (when not ignored), **`style.css`** header block (if matched).

## What Prettier must **not** format

- **`*.php`**, **`resources/views/**`** (Blade), **`app/**`** — use **EditorConfig** + **Pint** for PHP.
- **`vendor/`**, **`public/`**, **`node_modules/`**.

## Tailwind class order

**`prettier-plugin-tailwindcss`** is listed in **`.prettierrc`** → **`plugins`** — keep it **last** in that array if you add more Prettier plugins.

## EditorConfig

Match **2 spaces** for front-end files in `.editorconfig`; Prettier `tabWidth: 2` stays aligned.
