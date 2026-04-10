<{{ $tag }}
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    {{ $attributes->except('class') }}
>
    {{ $slot }}
</{{ $tag }}>
