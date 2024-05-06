@extends('layouts.auth')

@section('page.title', 'Вход')

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{__('Вход')}}
            </x-card-title>
        </x-card-header>

        <x-card-body>
            <x-form action="{{route('login.store')}}" method="POST">

                <x-form-item>
                    <x-label required>{{__('Логин')}}</x-label>
                    <x-input type="email" name="email" autofocus/>
                    <x-error name="email"/>
                </x-form-item>

                <x-form-item>
                    <x-label required>{{__('Пароль')}}</x-label>
                    <x-input type="password" name="password"/>
                    <x-error name="password"/>
                </x-form-item>

                <x-form-item>
                    <x-checkbox name="remember" :checked="!! old('remember')">
                        {{__('Запомнить меня')}}
                    </x-checkbox>
                    <x-error name="remember"/>
                </x-form-item>

                <x-button type="submit" class="w-100">
                    {{__('Вход')}}
                </x-button>

            </x-form>
        </x-card-body>
    </x-card>
@endsection
