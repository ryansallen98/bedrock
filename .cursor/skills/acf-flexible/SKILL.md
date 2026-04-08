---
name: acf-flexible
description: >-
  ACF/ACFE JSON-first sync, flexible.php → Blade layouts, Flexible composers,
  PHPUnit under tests/Flexible. Theme path web/app/themes/{THEME_SLUG}/.
---

# ACF flexible & JSON-first

**ACFE Gutenberg blocks** (separate pipeline): **`block.php`**, **`resources/views/blocks/`** — skill **`acf-blocks`**, rule **`12-acf-blocks.mdc`**.

**Cursor rules:** `.cursor/rules/05-theme-php-blade-acf.mdc` (ACF + Blade), `01-global-protocols.mdc` (flexible summary), **`10-testing-mandatory.mdc`**. **Skill:** **`testing-php-vitest`**.

## JSON first

- Field groups and ACFE types that support sync → files under `app/Integrations/acf/json/` (`field-groups/`, `post-types/`, `taxonomies/`, `option-pages/`, `forms/`, `block-types/`, `templates/`).
- Stable keys; `acfe_autosync` including `"json"` where applicable.
- **Do not** register the same schema in PHP (`acf_add_local_field_group`) if it already lives in JSON.

## Hooks vs schema

- **Hook** snippets (`acf/prepare_field`, `acf_form_head`, etc.) → `app/Integrations/acf/snippets/{security|admin|performance|frontend|integrations}/`, loaded via `SnippetsServiceProvider`.
- **`AcfServiceProvider`:** save/load paths, admin assets, non-schema behavior — not duplicate JSON registration.

## Flexible front-end

- Root **`flexible.php`** (ACFE dynamic render) maps layouts → `resources/views/flexible/{layout_name}.blade.php`.
- Layout / Blade names: **underscores only** (e.g. `featured_posts`), not hyphens.
- Page templates → partials → **`the_flexible('FIELD_NAME')`** — name must match the ACF field in JSON.
- **Per-row logic:** `App\View\Composers\Flexible/{Layout}.php` extending `Roots\Acorn\View\Composer` (or your project’s flexible base), targeting `flexible.{layout_slug}`. Blade stays presentational.

## Tests

- Add/update PHPUnit in `tests/Flexible/` for each layout or change.
- Cover empty/minimal payloads and bad config paths (no fatals).
- Term URLs: use `App\Support\WpLink` (or equivalent); **never** `esc_url()` on `WP_Error`.

## Consistency

Use the same field/group names in JSON, PHP, Blade, and tests (e.g. page builder field name).
