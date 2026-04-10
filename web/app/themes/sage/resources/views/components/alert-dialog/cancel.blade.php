<x-alert-dialog.primitive.cancel
    :autofocus="$autofocus"
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    {{ $attributes->except(['class', 'autofocus', 'variant', 'size', 'dataSlot']) }}
>
    {{ $slot }}
</x-alert-dialog.primitive.cancel>
