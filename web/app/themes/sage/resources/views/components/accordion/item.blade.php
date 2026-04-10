<x-accordion.primitive.item
    :open="$open"
    {{ $attributes->except('class') }}
    class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
>
  {{ $slot }}
</x-accordion.primitive.item>
