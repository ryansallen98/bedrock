<span
    data-slot="{{ $dataSlot }}"
    aria-current="page"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    {{ $attributes->except(['class', 'dataSlot']) }}
>
    {{ $slot }}
</span>
