---
name: acf-blocks
description: >-
  Invoke when adding or changing ACF/ACFE Gutenberg blocks: block.php render
  callback, blocks.* Blade under resources/views/blocks/, underscore slugs (like
  flexible), Composers/Blocks, JSON-first block-types, tests/Blocks. Triggers:
  new block, ACF block, Gutenberg block, block editor block.
---

# ACF / ACFE Gutenberg blocks

**Rule:** `.cursor/rules/12-acf-blocks.mdc` (includes **“When asked to add a new block”** checklist). **Flexible counterpart:** skill **`acf-flexible`** (`flexible.php`, `resources/views/flexible/`).

## New block — quick checklist

1. JSON in **`app/Integrations/acf/json/`** — block name → **`acf/{underscore_slug}`**.
2. ACFE render template → theme **`block.php`**.
3. **`resources/views/blocks/{slug}.blade.php`**
4. **`App\View\Composers\Blocks/{Name}.php`** → **`$views = ['blocks.{slug}']`**
5. **`tests/Blocks/`** + **`composer test`**

## Render pipeline

1. **ACFE** calls theme root **`block.php`** with **`$block`**, **`$post_id`**, **`$is_preview`**.
2. **`$slug`** = `str_replace('acf/', '', $block['name'])` → view name **`blocks.{slug}`**.
3. Blade: **`resources/views/blocks/{slug}.blade.php`**.

## Naming

- Use **underscores** in the slug (e.g. **`hero_banner`**) so it matches **`hero_banner.blade.php`** — same convention as flexible layouts.
- Keep **ACF block registration name**, **JSON** (`block-types/` etc.), **Blade**, **`protected static $views`** on the composer, and **tests** aligned on that slug.

## View composers

- **`App\View\Composers\Blocks/{BlockName}.php`** extending **`Roots\Acorn\View\Composer`**.
- **`protected static $views = ['blocks.{slug}'];`**
- Put queries, field defaults, and shaping here; keep **`block.php`** and Blade thin.

## Blade

- Presentation only — no heavy **`@php`**. See **`05-theme-php-blade-acf.mdc`** / **`09-blade-laravel-components.mdc`**.

## Tests

- **`tests/Blocks/`** — minimal/empty **`$block`**, preview, missing view (non-fatal). Run **`composer test`** before done (**`10-testing-mandatory.mdc`**).

## JSON

- Block types / fields: **`app/Integrations/acf/json/`** — no duplicating JSON schema in PHP.
