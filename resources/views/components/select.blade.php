@props(['value' => null, 'options' => []])

<select {{$attributes->class([
    'form-control',
]) }}>
{{$slot}}
</select>

