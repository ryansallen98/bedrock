<{{ $tag }}
    data-slot="{{ $dataSlot }}"
    data-variant="{{ $variant }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    {{ $attributes->except('class') }}
>
  {{ $slot }}
</{{ $tag }}>
