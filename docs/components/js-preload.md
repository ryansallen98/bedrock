# JS preload / hydration pattern (Shadpine UI)

Use this when a **Blade shell** is filled or driven by **Alpine** (or other deferred JS) so users do not see an **empty flash** before the client runs.

## Pattern

1. **Root** (the node with `x-data` or equivalent): add **`data-shadpine-hydrate="{widget}"`** (e.g. **`calendar`**) and  
   **`x-bind:data-js-hydrated="ready ? 'true' : null"`** once your factory exposes a boolean **`ready`**.
2. **Two layers** inside the root (siblings):
   - **`.shadpine-js-preload`** — **static** HTML only (no `x-for` / `x-show` that needs Alpine). Often built from **`x-skeleton`** and layout classes that match the hydrated UI.
   - **`.shadpine-js-live`** — Alpine-bound markup (`x-for`, `x-text`, etc.).
3. **CSS** (theme **`resources/css/theme.css`**):  
   - Until **`data-js-hydrated="true"`**, **`.shadpine-js-live`** is **`display: none`**.  
   - After hydration, **`.shadpine-js-preload`** is hidden.

Alpine removes **`data-js-hydrated`** when the bound value is **`null`**, so the “not hydrated” selectors match **before** Alpine loads and while **`ready`** is false.

## Reference implementation

- **Calendar:** `resources/views/components/calendar/preload.blade.php` (included from **`index.blade.php`**), **`calendar.ts`** **`ready`** + **`init()`** **`markReady()`** (after sync refresh and again after async **`loadCalendarLocale`** when applicable).

## Adding a new widget

1. Add **`data-shadpine-hydrate="your-widget"`** on the Alpine root (unique name).
2. Ship a **`preload.blade.php`** (or inline block) under the same component folder; keep tokens in **`config/components/*`** when possible so Tailwind can scan them.
3. Set **`ready = false`** in the Alpine factory; set **`ready = true`** in **`$nextTick`** after the first meaningful paint (and after any async setup), mirroring **`calendar`**.
4. Do not put **focusable** controls in the preload layer, or use **`pointer-events-none`** and **`aria-hidden="true"`** so the skeleton is decorative. Announce busy state on a parent if needed (**`aria-busy`**).

## Exporting

Copy the **`theme.css`** rules under the “Shadpine JS hydration” comment together with your preload partial and Alpine **`ready`** wiring.
