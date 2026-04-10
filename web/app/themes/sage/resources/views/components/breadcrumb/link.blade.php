<a
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    href="{{ $href }}"
    {{ $attributes->except(['class', 'href', 'dataSlot']) }}
>
    {{ $slot }}
</a>
