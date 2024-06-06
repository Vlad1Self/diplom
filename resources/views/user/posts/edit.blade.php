
@extends('layouts.main')

@section('page.title','Изменить товар')

@section('main.content')

    <x-title>
        {{__('Изменить товар')}}
    </x-title>

    <x-form action="{{route('user.posts.update', $post->id)}}" method="put" :post="$post" enctype="multipart/form-data">
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

        <div class="col-12 col-md-3">
            <div class="mb-3">
                <x-form.select name="categories_id[]" multiple>
                    @foreach($categories as $category)
                        <option @if(in_array($category->id, old('categories_id', []))) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

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

@endsection




