---
name: sage-frontend
description: >-
  Sage theme Vite/Tailwind/Alpine workflow: npm scripts, theme.css tokens,
  app.ts alpine glob, forbidden inline JS, WCAG 2.2 AAA gate. Use under
  web/app/themes/{THEME_SLUG}/ (sage in this template).
---

# Sage frontend (Vite + Tailwind + Alpine)

**Cursor rules:** `.cursor/rules/06-theme-alpine-vite.mdc`, **`14-shadpine-ui.mdc`**, **`10-testing-mandatory.mdc`**, **`11-frontend-formatting.mdc`**, **`13-mandatory-lint.mdc`**. **Skills:** **`shadpine-ui`** (Shadpine UI), **`testing-php-vitest`**, **`prettier-tailwind`**, **`linting-php-eslint`**.

## Working directory

```bash
cd web/app/themes/{THEME_SLUG}
```

Current template: `sage`.

## Commands

```bash
npm run dev
npm run build
npm run lint              # eslint + format:check
npm run lint:fix          # eslint --fix + format
npm run format
npm run format:check
npm run test
npm run typecheck
```

Run **`npm run lint`** (or **`format:check`** alone if only Prettier), **`npm run test`**, **typecheck**, and **build** before treating TS/CSS work as done; align with `docs/quality-audits.md` if present.

## Assets

- **Tokens:** `resources/css/theme.css` (`@theme`) — utilities map to tokens.
- **Shared classes:** `resources/css/app.css`, `resources/css/components.css` — prefer components before new one-off patterns.
- **Entries:** `resources/ts/app.ts` (Alpine + plugins); `editor.ts` if the theme uses it.
- **Alpine modules:** `resources/ts/alpine/**/*.ts`, eager-loaded via `import.meta.glob('./alpine/**/*.ts', { eager: true })`.

## Forbidden (theme UI)

- Inline `<script>`, `@push` script stacks
- `onclick` / `onkeydown` (and similar) for application behavior
- Non-bundled JS for theme interactions

## Accessibility

- Use `@alpinejs/collapse` and `@alpinejs/focus` where appropriate.
- Ship only after applicable **WCAG 2.2 AAA** checks for the pattern; see `docs/frontend-alpine.md`.

## theme.json

Generated from the Tailwind/build pipeline — **do not** treat hand-edited `theme.json` as source of truth.

## Vite

Configure path aliases (e.g. `@scripts`, `@styles`, `@fonts`, `@images`) in `vite.config.js` when the project uses them.
