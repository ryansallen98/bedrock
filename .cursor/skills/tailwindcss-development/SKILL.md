---
name: tailwindcss-development
description: >-
  Tailwind CSS v4 in Sage theme: @import "tailwindcss", @theme tokens in
  theme.css, @source paths, utilities in Blade. Use for layout, components,
  spacing, typography, dark mode. Skip for pure PHP or JS with no markup.
license: MIT
metadata:
  author: Ryan Allen
  adapted_from: laravel
---

# Tailwind CSS (Sage / Bedrock theme)

**Stack:** This project’s theme uses **Tailwind v4** (see `web/app/themes/{THEME_SLUG}/package.json`). Entry CSS typically uses `@import "tailwindcss"` (Sage may use `theme(static)` — match **`resources/css/app.css`**).

## Before changing CSS

- Read **`resources/css/app.css`**, **`resources/css/theme.css`**, and **`resources/css/components.css`** — follow existing `@theme` tokens and `@source` globs.
- Prefer **design tokens** (`@theme { ... }`) over magic values in Blade; map utilities to tokens per **`06-theme-alpine-vite.mdc`**.
- **Class order** in TS/CSS files covered by Prettier: **`prettier-plugin-tailwindcss`** (see **`11-frontend-formatting.mdc`**, skill **`prettier-tailwind`**). Run **`npm run format`** before merge.

## Tailwind v4 (CSS-first)

- Configure with **`@theme`** in CSS — no separate `tailwind.config.js` required for token definitions in v4-first setups.
- Import: **`@import "tailwindcss"`** (not legacy `@tailwind base/components/utilities`).
- **`corePlugins`** is not a v4 Tailwind option.

### Deprecated v3 → v4 replacements (when migrating snippets)

| Deprecated | Replacement |
|------------|-------------|
| `bg-opacity-*` | `bg-black/50` style opacity |
| `text-opacity-*` | `text-black/...` |
| `flex-shrink-*` | `shrink-*` |
| `flex-grow-*` | `grow-*` |
| `overflow-ellipsis` | `text-ellipsis` |

## Layout habits

- Prefer **`gap-*`** between flex/grid siblings instead of margin hacks when structuring new layouts.

## Dark mode

If the theme already uses **`dark:`** variants, new UI must follow the same pattern.

## Pitfalls

- Deprecated v3 utilities in new markup
- `@tailwind` directives instead of `@import "tailwindcss"`
- Spacing flex/grid children with margins when `gap` would be clearer
- Bypassing `@theme` with arbitrary values everywhere — extract tokens when repeated

## Docs

Use official **Tailwind v4** docs or project Context7/MCP for API details; Roots/Sage may add Vite-specific notes in `vite.config.js`.
