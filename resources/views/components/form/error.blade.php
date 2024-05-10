@props(['name' => ""])

@error($name)
<div {{ $attributes->class(['text-danger', 'mt-2']) }}>
    {{ $message }}
</div>
@enderror
