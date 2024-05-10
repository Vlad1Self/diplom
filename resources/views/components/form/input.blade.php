@props(['name' => ""])

<input {{ $attributes->class(['form-control', 'form-control-lg']) }} name="{{ $name }}"/>

<x-form.error name="{{ $name }}" />
