@extends('layouts.main')

@section('page.title','Изменить товар')

@section('main.content')

    <x-title>
        {{__('Изменить товар')}}
        <x-slot name="link">
            <a href="{{route('shop.show', $post->id)}}">
                {{__('Назад')}}
            </a>
        </x-slot>
    </x-title>

    <x-post.form action="{{route('user.posts.update', $post->id)}}" method="put" :post="$post"/>

@endsection




