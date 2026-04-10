<{{ $tag }}
    data-slot="{{ $dataSlot }}"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    {{ $attributes->except('class') }}
>
  {{ $slot }}
</{{ $tag }}>
