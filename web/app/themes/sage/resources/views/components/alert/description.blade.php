@props([
    'as' => 'div',
    'dataSlot' => 'alert-description',
])

@php
    $tag = $as;

    $classes = $tw->merge(
        "text-sm text-balance text-muted-foreground md:text-pretty [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground [&_p:not(:last-child)]:mb-4",
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
