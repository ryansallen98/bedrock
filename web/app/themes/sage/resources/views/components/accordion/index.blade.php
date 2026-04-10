<x-accordion.primitive.root {{ $attributes->except('class') }} class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}">
  {{ $slot }}
</x-accordion.primitive.root>
