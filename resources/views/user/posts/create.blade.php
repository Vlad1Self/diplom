@extends('layouts.main')

@section('page.title','Создать товар')

@section('main.content')

    <x-title>
        {{__('Создать товар')}}

        <x-slot name="link">
            <a href="{{route('user.posts')}}">
                {{__('Назад')}}
            </a>
        </x-slot>
    </x-title>

    <x-post.form action="{{route('user.posts.store')}}" method="POST" enctype="multipart/form-data"/>

@endsection
