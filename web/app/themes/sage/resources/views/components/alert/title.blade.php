@props([
    'as' => 'div',
    'dataSlot' => 'alert-title',
])

@php
    $tag = $as;

    $classes = $tw->merge(
        "cn-font-heading font-medium group-has-[>svg]/alert:col-start-2 [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground",
        $attributes->get('class')
    );
@endphp
 
<{{ $tag }} 
    data-slot="{{ $dataSlot }}" 
    class="{{ $classes }}"
    {{ $attributes->except('class') }}
>
    {{ $slot }}
</{{ $tag }}>
