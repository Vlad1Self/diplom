@props(['name' => ""])

<select name="{{ $name }}" {{ $attributes->class(['form-select', 'form-select-lg']) }}>
    {{ $slot }}
</select>
<x-form.error name="{{ $name }}" />
