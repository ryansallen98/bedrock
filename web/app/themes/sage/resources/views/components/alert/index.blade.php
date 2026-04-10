<div
  data-slot="{{ $dataSlot }}"
  role="{{ $role }}"
  class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}"
  {{ $attributes->except('class') }}
>
  {{ $slot }}
</div>
