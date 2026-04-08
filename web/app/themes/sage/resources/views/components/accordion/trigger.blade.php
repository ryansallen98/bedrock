@php
  $base = "group/accordion-trigger relative flex flex-1 items-start justify-between rounded-lg border border-transparent py-2.5 text-left text-sm font-medium transition-all outline-none hover:underline focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50 focus-visible:after:border-ring disabled:pointer-events-none disabled:opacity-50 **:data-[slot=accordion-trigger-icon]:ml-auto **:data-[slot=accordion-trigger-icon]:size-4 **:data-[slot=accordion-trigger-icon]:text-muted-foreground";
  $classes = $tw->merge($base, $attributes->get('class'));
@endphp

<x-accordion.primitive.trigger {{ $attributes->except('class') }} class="{{ $classes }}">
  {{ $slot }}
  <x-lucide-chevron-down
    data-slot="accordion-trigger-icon"
    class="pointer-events-none shrink-0 group-aria-expanded/accordion-trigger:hidden"
    aria-hidden="true"
  />
  <x-lucide-chevron-up
    data-slot="accordion-trigger-icon"
    class="pointer-events-none hidden shrink-0 group-aria-expanded/accordion-trigger:inline"
    aria-hidden="true"
  />
</x-accordion.primitive.trigger>