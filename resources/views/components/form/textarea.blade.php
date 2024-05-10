@props(['name' => "", 'placeholder' => ""])

<textarea {{ $attributes->class(['form-control', 'form-control-lg', 'text-dark']) }}  name="{{ $name }}" placeholder="{{ $placeholder }}">{{ $slot }}</textarea>
<x-form.error name="{{ $name }}" />
