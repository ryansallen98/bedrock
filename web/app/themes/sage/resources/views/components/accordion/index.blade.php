@php
  $base = 'flex w-full flex-col';
  $classes = $tw->merge($base, $attributes->get('class'));
@endphp

<x-accordion.primitive.root {{ $attributes->except('class') }} class="{{ $classes }}">
  {{ $slot }}
</x-accordion.primitive.root>