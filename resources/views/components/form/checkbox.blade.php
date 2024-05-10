@props(['name' => ""])

<div class="form-check mb-2">
    <label class="form-check-label user-select-none text-dark" for="flexCheckDefault" >
        {{ $slot }}
    </label>
    <input name="{{ $name }}" {{ $attributes->class(['form-check-input']) }} type="checkbox" id="flexCheckDefault" >
    <x-form.error name="{{ $name }}" />
</div>
