<div
    role="none"
    data-slot="{{ $dataSlot }}"
    data-orientation="{{ $orientationKey }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    {{ $attributes->except(['class', 'orientation', 'dataSlot']) }}
></div>
