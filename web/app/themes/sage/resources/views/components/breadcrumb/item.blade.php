<li data-slot="{{ $dataSlot }}" class="{{ $tw->merge($classes, $attributes->get('class') ?? '') }}" {{ $attributes->except(['class', 'dataSlot']) }}>
    {{ $slot }}
</li>
