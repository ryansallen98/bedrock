<x-alert-dialog.primitive.root
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
    :default-open="$defaultOpen"
    {{ $attributes->except(['class', 'default-open', 'defaultOpen']) }}
>
    {{ $slot }}
</x-alert-dialog.primitive.root>
