<optgroup
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($groupClasses, $attributes->get('class') ?? '') }}"
    label="{{ $label }}"
    @disabled($disabled)
    {{ $attributes->except(['class', 'label', 'disabled']) }}
>{{ $slot }}</optgroup>
