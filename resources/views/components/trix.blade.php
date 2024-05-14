@props(['name', 'value' => ''])

<input {{ $attributes->class([
    'form-control',
])->merge([
    'type' => 'hidden',
    'name' => $name,
    'id' => $name,
    'value' => old($name) ?: $value,
]) }}>
<trix-editor input="{{ $name }}"></trix-editor>
