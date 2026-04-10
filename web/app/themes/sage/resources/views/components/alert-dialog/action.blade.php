<x-alert-dialog.primitive.action
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    {{ $attributes->except(['class', 'variant', 'size', 'dataSlot']) }}
>
    {{ $slot }}
</x-alert-dialog.primitive.action>
