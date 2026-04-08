---
name: shadpine-ui
description: >-
  Shadpine UI: Alpine.js components inspired by shadcn/ui — Blade primitives
  in resources/views/components, TS in resources/ts/components, config/classes,
  Vitest. Framework-agnostic idea (Alpine + templating + CSS); this repo uses
  Blade + Tailwind + $tw merge.
---

# Shadpine UI

**Shadpine UI** — Alpine components inspired by [shadcn/ui](https://ui.shadcn.com/). Same **primitive / styled** split as shadcn; markup can be ported to another templating stack (e.g. Astro); Tailwind can be swapped for traditional CSS if you adapt class maps.

**Rule:** `.cursor/rules/14-shadpine-ui.mdc` (mirror: `.claude/rules/`). **Catalog:** [`docs/components/INDEX.md`](../../../docs/components/INDEX.md).

## When to use

- New or updated **Shadpine UI** widgets aligned with a shadcn/ui component.
- Accordion, alert, button, or future dialog, menu, tabs, etc.

## Checklist (new interactive component)

1. **Parity:** identify the shadcn/ui component and props/slots to mirror.
2. **`primitive/`** — roles, `aria-*`, keyboard handlers, `x-data` / `x-id`, minimal classes.
3. **Styled layer** — `data-slot`, `$tw->merge(base, …, $attributes->get('class'))`, slots.
4. **`config/classes/{name}.php`** when the component has **variants/sizes** (CVA-style).
5. **`resources/ts/components/{name}.ts`** — `export function name(...)` for Alpine; register in **`app.ts`** via `Alpine.data('name', name)`.
6. **`resources/ts/components/__tests__/{name}.test.ts`** — Vitest coverage for state and helpers.
7. **`docs/components/{name}.md`** — APG link, props, file map; add a row to **`docs/components/INDEX.md`**.
8. **Verify:** `npm run lint`, `npm run test`, `npm run typecheck`, `npm run build` from theme directory.

## Project habit

- **Prefer** `resources/views/components/*` (Shadpine UI) instead of duplicate one-off markup.

## Related skills

- **`sage-frontend`** — Vite, Alpine plugins, `app.ts`.
- **`tailwindcss-development`** — tokens and utilities.
- **`testing-php-vitest`** — Vitest policy.
- **`linting-php-eslint`** — ESLint + Prettier.
