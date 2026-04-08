---
name: wordpress-plugins
description: >-
  First-party Bedrock plugins: TypeScript/SCSS builds, strict PHP, agent
  scaffold, admin/frontend templates, theme override lookup, versioning.
  Paths under web/app/plugins/{slug}/.
---

# WordPress first-party plugins

**Cursor rules:** `.cursor/rules/04-wordpress-plugins.mdc`, `02-typescript-php-build.mdc`, `03-scaffold-git-versioning.mdc`.

## Build & quality

- **TS →** built, minified JS; **SCSS →** built CSS; enqueue **dist**, not raw `src/`.
- Document `npm run build`, `npm test`, `npm run typecheck` (and `composer test`) in README / `package.json`.
- New PHP: `declare(strict_types=1);` after `<?php` and file docblock.
- Run tests before finishing substantive PHP/JS changes.

## New plugin checklist

1. **`web/app/plugins/{slug}/`** with README, `.gitignore`, build pipeline.
2. **Git:** if Bedrock ignores `web/app/plugins/*`, add `!web/app/plugins/{slug}/` to root `.gitignore`. **Do not** `git init` inside the plugin folder in a monorepo-only workflow.
3. **Authorship:** Ryan Allen — https://rallendev.com — https://github.com/ryansallen98 — in headers, `readme.txt`, `composer.json`, `package.json`.
4. **Version + `changelog.txt`** at plugin root on every substantive change (see `03-scaffold-git-versioning.mdc`).

## Agent scaffold (initial commit)

Mirror **`{REFERENCE_PLUGIN}`** (e.g. `logical-media-folders`) when available:

- `CLAUDE.md`, `.claude/`, `.claude/rules/plugin-agents.md`, optional `.claude/skills/wordpress-plugin/`
- `.claude/settings.json`, `.cursor/mcp.json` (no secrets), optional `.cursor/rules/wordpress-plugin.mdc`
- `templates/admin/`, `templates/frontend/`

## Templates

- No large HTML strings in domain classes — use `templates/` + loader.
- **Override order (frontend):** child theme → parent theme → plugin, under `{$plugin_slug}/templates/frontend/{path}` (see `04-wordpress-plugins.mdc`).
- Required file header + `declare(strict_types=1);` + `defined('ABSPATH') || exit;` on template partials.
- Escape and i18n with the plugin **text domain**.

## Naming

Neutral, descriptive slug and PHP/REST prefixes — not client brand unless requested.
