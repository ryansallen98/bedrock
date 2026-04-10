<x-alert-dialog.primitive.trigger
    :as="$as"
    data-slot="{{ $dataSlot }}"
    {{ $attributes->except(['class', 'as', 'dataSlot']) }}
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
>
    {{ $slot }}
</x-alert-dialog.primitive.trigger>
