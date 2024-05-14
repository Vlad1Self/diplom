@extends('layouts.main')

@props(['post' => null, 'categories' => null])

@section('page.title','Создать товар')

@section('main.content')

    <x-title>
        {{__('Создать товар')}}

        <x-slot name="link">
            <a href="{{route('shop')}}">
                {{__('Назад')}}
            </a>
        </x-slot>
    </x-title>

    <x-form {{$attributes}} action="{{route('user.posts.store')}}" method="POST" enctype="multipart/form-data">
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
                <x-form.select name="category_id[]" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                        <x-error name="category_id"/>
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
