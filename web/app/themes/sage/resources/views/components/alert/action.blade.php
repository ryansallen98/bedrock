@props([
    'dataSlot' => 'alert-action',
])

@php
    $classes = $tw->merge(
        "absolute top-2 right-2",
        $attributes->get('class')
    );
@endphp
 
<div
    data-slot="{{ $dataSlot }}" 
    class="{{ $classes }}"
    {{ $attributes->except('class') }}
>
    {{ $slot }}
</div>
