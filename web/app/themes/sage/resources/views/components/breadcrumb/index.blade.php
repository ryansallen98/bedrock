<nav
    aria-label="{{ $label }}"
    data-slot="{{ $navDataSlot }}"
    {{ $attributes->except(['class', 'ariaLabel']) }}
>
    <ol data-slot="{{ $listDataSlot }}" class="{{ $tw->merge($listClasses, $attributes->get('class') ?? '') }}">
        {{ $slot }}
    </ol>
</nav>
