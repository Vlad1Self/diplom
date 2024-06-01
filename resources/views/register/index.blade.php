@extends('layouts.main')

@section('page.title', 'Регистрация')

@section('content')

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-4">
                <form action="{{ route('register.store') }}" method="POST" class="p-5 border rounded shadow bg-white">
                    @csrf

                    <h1 class="text-center mb-4">Регистрация</h1>

                    <div class="form-group mb-2">
                        <label for="name">Имя</label>
                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required minlength="8">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password_confirmation">Подтверждение пароля</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <x-form-item>
                        <x-checkbox name="agreement" :checked="!! old('remember')">
                            {{__('Я согласен на обработку пользовательских данных')}}
                        </x-checkbox>
                        <x-error name="agreement"/>
                    </x-form-item>

                    <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>

                </form>
            </div>
        </div>
    </div>

@endsection
