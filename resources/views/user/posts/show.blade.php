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
        <img src="{{ asset("storage/$post->image_path") }}" class="img-fluid" alt="">

    </div>

    <p>
        {{ $post -> price }} руб.

    </p>
    {!! $post->content !!}

    <div class="col-md-6">
        {{--<p>Цена: {{ number_format($post->price, 2, '.', '') }}</p>--}}
        <!-- Форма для добавления товара в корзину -->
        <form action="{{ route('basket.add', ['id' => $post->id]) }}"
              method="post" class="form-inline">
            @csrf
            <label for="input-quantity">{{__('Количество')}}</label>
            <input type="text" name="quantity" id="input-quantity" value="1"
                   class="form-control mx-2 w-25 d-inline">
            <button type="submit" class="btn btn-success">{{__('Добавить в корзину')}}</button>
        </form>
    </div>
@endsection




