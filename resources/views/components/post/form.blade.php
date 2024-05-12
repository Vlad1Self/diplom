@props(['post' => null, 'categories' => null])

<x-form {{$attributes}}>
    <x-form-item>
        <x-label required>{{__('Название товара')}}</x-label>
        <x-input name="title" value="{{$post->title ?? ''}}" autofocus/>
        <x-error name="title"/>
    </x-form-item>

    <x-form-item>
        <x-label required>{{__('Цена товара')}}</x-label>
        <x-input name="price" value="{{$post->price ?? ''}}"/>
        <x-error name="price"/>
    </x-form-item>




    <x-form-item>
        <x-label required>{{__('Описание товара')}}</x-label>

        <x-trix name="content" value="{{$post->content ?? ''}}"/>
        <x-error name="content"/>
    </x-form-item>

    <x-form.item>
        <x-form.input type="file" name="image"/>
    </x-form.item>

    <x-button type="submit">
        {{__('Сохранить')}}
    </x-button>

</x-form>
