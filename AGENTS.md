# Agent guidelines (Bedrock + Sage)

This repo is **WordPress Bedrock + Sage (Acorn)**, not a full Laravel 13 app. Many [Laravel Boost](https://github.com/laravel/boost)-style habits still apply to **Acorn**, **Blade**, **Pint**, and **PHPUnit** in the theme; **Eloquent, `php artisan make:model`, Laravel Boost MCP, and Boost `search-docs`** are **not** defaults here unless the project adds them.

**Canonical stack index:** [`CLAUDE.md`](CLAUDE.md) (tokens, rule table, skills table). **Mirrors / sync:** [`.claude/rules/bedrock-sage-bootstrap.md`](.claude/rules/bedrock-sage-bootstrap.md). **Cursor rules:** `.cursor/rules/*.mdc`.

---

## Skills — activate early

Do **not** wait until stuck. Open the matching **`.claude/skills/*/SKILL.md`** (mirrored under **`.cursor/skills/`**) when the task fits:

| Skill | When |
|--------|------|
| `bedrock-sage` | Bedrock layout, setup, root lint, theme commands, Acorn |
| `sage-frontend` | Vite, Tailwind, Alpine, `app.ts`, editor/build |
| `tailwindcss-development` | Tailwind utilities, layout, dark mode, responsive UI |
| `acf-flexible` | `flexible.php`, flexible layouts, composers, `tests/Flexible` |
| `acf-blocks` | `block.php`, `resources/views/blocks/`, `tests/Blocks` |
| `acorn-laravel` | Theme PHP: DI, `config()`, Blade/Laravel idioms |
| `testing-php-vitest` | PHPUnit + Vitest commands and policies |
| `linting-php-eslint` | Pint + ESLint; theme `composer run lint`, `npm run lint` |
| `prettier-tailwind` | Prettier + Tailwind class sort |
| `deploy-scripts` | CI, deploy, `THEME_DIR` |
| `wordpress-plugins` | First-party plugins under `web/app/plugins/` |
| `shadpine-ui` | **Shadpine UI** — Alpine components inspired by shadcn/ui: `components/`, `primitive/`, TS, tests |

---

## Conventions

- Follow **sibling files** in the same directory for structure, naming, and patterns before inventing new ones.
- Use **descriptive** names (`isRegisteredForNewsletter`, not vague `check()`).
- **Reuse** Blade components, composers, and TS modules before adding parallel implementations.
- **Prefer** theme `resources/views/components/` (**Shadpine UI**) for interactive and styled UI — see **`14-shadpine-ui.mdc`** and skill **`shadpine-ui`**.

---

## Verification

- Prefer **automated tests** over one-off “verification scripts” or throwaway PHP when tests can prove behavior (**`10-testing-mandatory.mdc`**).
- **WP-CLI / `wp shell`** may be used sparingly for exploration; do not replace PHPUnit with ad-hoc scripts for logic you will ship.

---

## Structure & dependencies

- Do **not** add new **top-level** repo directories or change **Composer / npm** dependencies without explicit user approval (starter template discipline).

---

## Frontend (Vite)

- If assets or the UI do not update: run **`npm run dev`** or **`npm run build`** in **`web/app/themes/{THEME_SLUG}/`** (see **`sage-frontend`**). Vite manifest errors usually mean dev server not running or build stale.

---

## Documentation

- Add **new documentation files** (e.g. under `docs/`) only when the **user explicitly asks** — otherwise keep changes in code, rules, and existing hubs (`CLAUDE.md`, this file).

---

## Communication

- Stay **concise**: rationale + code or steps; avoid narrating obvious IDE mechanics.

---

## PHP (Sage theme)

- After editing theme **PHP** (e.g. **`app/**/*.php`**, **`functions.php`**, **`block.php`**), run **Pint** from the theme directory: **`composer run lint:fix`** (or **`composer run lint`** to check). Same spirit as Laravel Boost’s “format before finalize.” Rule **`13-mandatory-lint.mdc`**.
- Prefer **explicit return types** and parameter types; **curly braces** on all control structures (even single-line bodies).
- Use **constructor property promotion** when it clarifies DI; omit empty constructors.
- Prefer **PHPDoc** for complex arrays/contracts; use **inline comments** only for non-obvious logic.
- **Enums:** TitleCase case names when you use backed enums.

---

## PHPUnit (theme)

- Use **`./vendor/bin/phpunit --filter=TestName`** (or path to one file) while iterating; then **`composer test`** before done.
- Do **not** delete tests or test files without **explicit user approval**.
- Cover **happy paths, failures, and edge cases** for non-trivial behavior.
- After focused tests pass, it is reasonable to suggest running the **full** theme suite (and **`npm run test:theme`** from repo root — Pint, PHPUnit, ESLint + Prettier check, Vitest, **`npm run build`** / typecheck + Vite) before merge.

---

## Not applicable by default

- Laravel Boost **MCP** tools (`database-query`, `get-absolute-url`, `browser-logs`, etc.) unless you configure equivalent MCP for this project.
- **`php artisan make:*`** for migrations/models as the default workflow (WordPress is source of truth).
- **Pest** — this template uses **PHPUnit** classes.
- **`php artisan test`** — theme uses **`composer test`** / **`vendor/bin/phpunit`**.

---

*Derived in spirit from Laravel Boost / AGENTS patterns; scoped to this Bedrock + Sage starter.*
