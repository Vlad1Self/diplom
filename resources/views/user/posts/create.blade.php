@extends('layouts.main')

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

    <x-post.form action="{{route('user.posts.store')}}" method="POST" enctype="multipart/form-data">
        <div class="col-12 col-md-3">
            <div class="mb-3">
                <x-form.select name="category_id">
                    @foreach($categories as $category)
                        <option @if(in_array($category->id, old('category_id', []))) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>
    </x-post.form>

@endsection
