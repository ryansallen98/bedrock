@props([
    'as' => 'button',
    'variant' => 'default',
    'size' => 'default',
    'dataSlot' => 'button'
])

@php
    $config = config('classes.button');
    $allowed = ['a', 'button', 'span', 'div'];
    $tag = in_array($as, $allowed, true) ? $as : 'button';

    $classes = $tw->merge(
        $config['base'],
        $config['variants'][$variant] ?? $config['variants']['default'],
        $config['icon_sizes'][$size] ?? $config['icon_sizes']['default'],
        $attributes->get('class')
    );
@endphp

<{{ $tag }} 
    data-slot="{{ $dataSlot }}"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    class="{{ $classes }}" 
    {{ $attributes->except('class') }}
>
  {{ $slot }}
</{{ $tag }}>