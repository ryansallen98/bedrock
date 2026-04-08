@props([
  'level' => 3,
  'dataSlot' => 'accordion-trigger',
])

<h{{ $level }} 
  class="flex"
  :data-state="isOpen($id('acc')) ? 'open' : 'closed'"
>
  <button
    data-slot="{{ $dataSlot }}"
    data-level="{{ $level }}"
    {{ $attributes->except([
      'data-slot',
      'level',
    ]) }}
    type="button"
    :id="`acc_${$id('acc')}`"
    :aria-controls="`panel_${$id('acc')}`"
    :aria-expanded="isOpen($id('acc'))"
    :data-state="isOpen($id('acc')) ? 'open' : 'closed'"
    @click="toggle($id('acc'))"
    @keydown.arrow-down.prevent="moveFocus(1, $el)"
    @keydown.arrow-up.prevent="moveFocus(-1, $el)"
    @keydown.home.prevent="focusList[0]?.focus()"
    @keydown.end.prevent="focusList[focusList.length-1]?.focus()"
    x-init="registerTrigger($el)"
  >
    {{ $slot }}
  </button>
</h{{ $level }}>