@extends('layouts.auth')

@section('page.title', 'Регистрация')

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{__('Регистрация')}}
            </x-card-title>
        </x-card-header>

        <x-card-body>


            <x-form action="{{route('register.store')}}" method="POST">
                <x-form-item>
                    <x-label required>{{__('Имя')}}</x-label>
                    <x-input name="name" autofocus/>
                    <x-error name="name"/>
                </x-form-item>

                <x-form-item>
                    <x-label required>{{__('Логин')}}</x-label>
                    <x-input type="email" name="email"/>
                    <x-error name="email"/>
                </x-form-item>

                <x-form-item>
                    <x-label required>{{__('Пароль')}}</x-label>
                    <x-input type="password" name="password"/>
                    <x-error name="password"/>
                </x-form-item>

                <x-form-item>
                    <x-label required>{{__('Подтверждение пароля')}}</x-label>
                    <x-input type="password" name="password_confirmation"/>
                    <x-error name="password_confirmation"/>
                </x-form-item>

                <x-form-item>
                    <x-checkbox name="agreement" :checked="!! old('agreement')">
                        {{__('Я согласен на обработку пользовательских данных')}}
                    </x-checkbox>
                    <x-error name="agreement"/>
                </x-form-item>

                <x-button type="submit" class="w-100">
                    {{__('Вход')}}
                </x-button>

            </x-form>
        </x-card-body>
    </x-card>
@endsection
