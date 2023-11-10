<!-- resources/views/components/label.blade.php -->

@props(['value'])

<label {{ $attributes->merge(['class' => 'font-bold']) }}>
    {{ $value ?? $slot }}
</label>
