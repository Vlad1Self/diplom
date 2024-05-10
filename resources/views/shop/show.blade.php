@extends('layouts.main')

@section('page.title','Просмотр товара')

@section('main.content')

    <x-title>
        {{__('Просмотр товара')}}

        <x-slot name="link">
            <a href="{{route('shop')}}">
                {{__('Назад')}}
            </a>
        </x-slot>

        <x-slot name="right">
            <div class="d-flex justify-content-between align-items-center">
                <x-button-link href="{{route('user.posts.edit', $post->id)}}">
                    {{__('Изменить')}}
                </x-button-link>

                <form action="{{route('user.posts.delete', $post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" class="mx-2">{{__('Удалить')}}</x-button>
                </form>
            </div>
        </x-slot>
    </x-title>

    <h2 class="h4">
        {{$post->title}}
    </h2>

    <div class="pt-3">
        {!! $post->content !!}
    </div>

@endsection




