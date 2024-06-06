@extends('layouts.main')

@props(['post' => null, 'categories' => null])

@section('page.title','Создать товар')

@section('main.content')

    <x-title>
        {{__('Создать товар')}}
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
                <x-form.select name="categories_id[]" multiple>
                    @foreach($categories as $category)
                        <option @if(in_array($category->id, old('categories_id', []))) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <x-form-item>
            <x-label required>{{__('Описание товара')}}</x-label>
            <textarea name="content" class="form-control" rows="3">{{ old('content', $post->content ?? '') }}</textarea>
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
