@props([
  'dataSlot' => 'alert',
  'role' => 'alert',
  'variant' => 'default',
])
@php
  $config = config('classes.alert');
  $classes = $tw->merge(
    $config['base'],
    $config['variants'][$variant] ?? $config['variants']['default'],
    $attributes->get('class')
  );
@endphp

<div 
  data-slot="{{ $dataSlot }}" 
  role="{{ $role }}" 
  class="{{ $classes }}"
  {{ $attributes->except('class') }}
>
  {{ $slot }}
</div>
