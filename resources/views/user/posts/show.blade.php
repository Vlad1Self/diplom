@extends('layouts.main')

@section('page.title','Просмотр товара')

@section('main.content')

    <x-title>
        {{__('Просмотр товара')}}

        <x-slot name="right">
            @can('viewAny', App\Models\User::class)
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
            @endcan
        </x-slot>
    </x-title>

    <h2 class="h4">
        {{$post->title}}
    </h2>

    <div class="pt-3">
        <img src="{{ asset("storage/$post->image_path") }}" class="img-fluid" alt="">

    </div>

    <div class="d-flex justify-content-between align-items-center">
        <strong class="h4">{{ $post -> price }} ₽</strong>
    </div>
    <p class="text-muted small">Цена за 1 кг</p>
    {!! $post->content !!}


@endsection




