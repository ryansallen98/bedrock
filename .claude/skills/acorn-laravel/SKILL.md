---
name: acorn-laravel
description: >-
  Laravel patterns that apply inside Sage/Acorn theme PHP: DI, config(), Str/
  Collection, Blade components, security for HTTP layer. Explicitly excludes
  Eloquent/migrations/queues unless the project adds them.
license: MIT
metadata:
  author: Ryan Allen
  adapted_from: laravel-best-practices
---

# Acorn / Laravel (Sage theme)

**Cursor rules:** `.cursor/rules/08-acorn-php-laravel.mdc`, `.cursor/rules/09-blade-laravel-components.mdc`.

## When this applies

- PHP under **`web/app/themes/{THEME_SLUG}/app/`**, **`config/`**, **`functions.php`**, **`routes/`** (if present).
- Blade under **`resources/views/`** when using **components**, **`$attributes`**, **`@pushOnce`**.

## Use WordPress for data

- **Posts, users, meta, options, taxonomies:** WordPress APIs (`WP_Query`, `get_post_meta`, etc.) — not Eloquent, unless the repo explicitly introduces models.
- Do **not** assume `RefreshDatabase`, factories, or migrations for theme work; theme tests use **PHPUnit** per project layout.

## Consistency first

Match sibling **ServiceProviders**, **Composers**, and **Snippets** before introducing new Laravel patterns.

## High-value Laravel habits (theme-safe)

| Topic | Do |
|--------|-----|
| Config | `env()` only in `config/*.php`; use `config()` elsewhere |
| Env | `app()->isProduction()` / `App::environment()` |
| DI | Constructor injection; avoid `app()` in class bodies when avoidable |
| Strings | `Str::`, `mb_*` for multibyte |
| HTTP input | Validate; use validated data only for writes |
| SQL (if `DB::`) | Always bind parameters |
| Blade output | `{{ }}` by default; `{!! !!}` only when trusted/sanitized |

## Blade components

- **`$attributes->merge([...])`** for extensible class lists.
- **Components over `@include`** for explicit props.
- **`@pushOnce`** for stack content that must not duplicate in loops.

## Not default theme concerns

- Mass Eloquent assignment, policies on models (unless models exist)
- Horizon, mail, notifications, schedule (unless registered)
- `Route::resource` / API resource conventions — follow existing Acorn routes only

For full Laravel reference, use **installed Acorn/Laravel version** docs — this skill is a **Bedrock+Sage filter** of generic Laravel guidance.
