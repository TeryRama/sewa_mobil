<!-- resources/views/components/input.blade.php -->

@props(['id', 'type', 'name', 'value' => '', 'required', 'autofocus' => false])

<input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" @if($required) required @endif @if($autofocus) autofocus @endif {{ $attributes->merge(['class' => 'form-control']) }}>
