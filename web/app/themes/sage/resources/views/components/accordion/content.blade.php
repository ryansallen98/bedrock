@php
  $base = 'grid overflow-hidden text-sm transition-[grid-template-rows] duration-200 ease-out motion-reduce:duration-0 data-[state=closed]:grid-rows-[0fr] data-[state=open]:grid-rows-[1fr]';
  $classes = $tw->merge($base, $attributes->get('class'));
@endphp

<x-accordion.primitive.content {{ $attributes->except('class') }} class="{{ $classes }}">
  <div class="min-h-0 overflow-hidden">
    <div class="pt-0 pb-2.5 [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground [&_p:not(:last-child)]:mb-4">
      {{ $slot }}
    </div>
  </div>
</x-accordion.primitive.content>