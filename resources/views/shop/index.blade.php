@extends('layouts.main')

@section('main.content')

    <x-title>
        {{__('Список товаров')}}

        <x-slot name="right">
            <x-button-link href="{{route('user.posts.create')}}">
                {{__('Создать')}}
            </x-button-link>
        </x-slot>
    </x-title>

 @include ('shop.filter')


    @if(empty($posts))
        {{__('Нет ни одного товара')}}
     @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-12 col-md-3">
                    <x-post.card :post="$post"/>
                </div>
            @endforeach
        </div>
    @endif
@endsection




