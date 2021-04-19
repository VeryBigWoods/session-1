@props([
    'options' => "{dateFormat:'Y-m-d H:i:S', altFormat:'G:i K, F j, Y', altInput:true, enableTime:true }",
])

<div wire:ignore>
    <input x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input
        {{ $attributes }} />
</div>
