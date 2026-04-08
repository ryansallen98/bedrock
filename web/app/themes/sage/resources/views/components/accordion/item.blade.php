@php
  $base = 'not-last:border-b';
  $classes = $tw->merge($base, $attributes->get('class'));
@endphp

<x-accordion.primitive.item {{ $attributes->except('class') }} class="{{ $classes }}">
  {{ $slot }}
</x-accordion.primitive.item>