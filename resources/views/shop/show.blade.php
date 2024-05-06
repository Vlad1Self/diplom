@extends('layouts.main')

@section('main.content')

    <x-title>

        {{$post->title}}

        <x-slot name="link">

            <a href="{{route('shop')}}">
                {{__('Назад')}}
            </a>

        </x-slot>

    </x-title>

    {!! $post->content !!}

@endsection




