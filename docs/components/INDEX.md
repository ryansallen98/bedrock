# Shadpine UI — component catalog

**Shadpine UI** is an **Alpine.js** component kit **inspired by [shadcn/ui](https://ui.shadcn.com/)**. The ideas are **portable**: you need **Alpine**, a **templating layer**, and styling (**Tailwind** here with PHP **Tailwind Merge** as `$tw`; you could use plain CSS or another utility setup). **This repository** implements Shadpine UI with **Blade** under the Sage theme.

**Stack rules:** [`.cursor/rules/14-shadpine-ui.mdc`](../../.cursor/rules/14-shadpine-ui.mdc) · **Skill:** `shadpine-ui`

**Theme paths** (replace `sage` if the theme was renamed):

- Styled components: `web/app/themes/sage/resources/views/components/{name}/`
- Primitives (a11y + behavior): `web/app/themes/sage/resources/views/components/{name}/primitive/`
- Alpine logic: `web/app/themes/sage/resources/ts/components/{name}.ts` (registered in `resources/ts/app.ts`)
- Shared class maps: `web/app/themes/sage/config/classes/{name}.php`

## Conventions (quick)

| Layer | Change styling here | Change behavior / ARIA here |
|-------|---------------------|------------------------------|
| Styled | `{name}/*.blade.php` (not under `primitive/`) | Avoid — delegate to primitive |
| Primitive | Minimal classes only | `{name}/primitive/*.blade.php` |
| State / keyboard | — | `{name}.ts` + primitive event bindings |

- Override consumer classes: pass `class="..."` on the component; primitives/styled use **`$tw->merge(..., $attributes->get('class'))`**.
- **Accessibility:** every new interactive primitive must pass the checklist in **`14-shadpine-ui.mdc`**; each component doc below lists the APG pattern and files.

## Component list

| Component | shadcn/ui reference | Documentation |
|-----------|---------------------|---------------|
| Accordion | [Accordion](https://ui.shadcn.com/docs/components/accordion) | [accordion.md](accordion.md) |
| Alert | [Alert](https://ui.shadcn.com/docs/components/alert) | [alert.md](alert.md) |
| Button | [Button](https://ui.shadcn.com/docs/components/button) | [button.md](button.md) |

## Adding a component

1. Pick the shadcn/ui widget and APG pattern (if interactive).
2. Add `primitive/` only when the widget needs managed focus, ARIA, or Alpine state.
3. Add `resources/ts/components/{name}.ts` + `resources/ts/components/__tests__/{name}.test.ts` when there is TS state.
4. Add `config/classes/{name}.php` when you have variants/sizes like CVA.
5. Register Alpine in `resources/ts/app.ts`.
6. Add **`docs/components/{name}.md`** and a row in the table above.
7. Run theme **`npm run lint`**, **`npm run test`**, **`npm run typecheck`**, **`npm run build`** when TS/Blade change.
