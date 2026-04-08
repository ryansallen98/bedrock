@props([
    'as' => 'span',
    'variant' => 'default',
    'dataSlot' => 'badge',
])
@php
    $config = config('classes.badge');
    $allowed = ['a', 'button', 'span', 'div'];
    $tag = in_array($as, $allowed, true) ? $as : 'span';

    $classes = $tw->merge(
        $config['base'],
        $config['variants'][$variant] ?? $config['variants']['default'],
        $attributes->get('class')
    );
@endphp

<{{ $tag }} 
    data-slot="{{ $dataSlot }}"
    data-variant="{{ $variant }}"
    class="{{ $classes }}" 
    {{ $attributes->except('class') }}
>
  {{ $slot }}
</{{ $tag }}>