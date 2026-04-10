<option
    data-slot="{{ $dataSlot }}"
    class="{{ $tw->merge($optionClasses, $attributes->get('class') ?? '') }}"
    @selected($selected)
    {{ $attributes->except(['class', 'selected']) }}
>{{ $slot }}</option>
