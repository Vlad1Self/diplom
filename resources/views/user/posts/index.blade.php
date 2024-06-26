@extends('layouts.main')

@section('page.title','Мои товары')

@section('main.content')

    <x-title>
        {{__('Мои товары')}}
    </x-title>

    @if(empty($posts))
        {{__('Нет ни одного товара')}}
    @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-12 col-md-3">
                    <x-post.cardmygoods :post="$post"/>
                </div>
            @endforeach
        </div>
    @endif
@endsection




