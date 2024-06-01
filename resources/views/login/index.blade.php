@extends('layouts.main')

@section('page.title', 'Вход')

@section('content')

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-4">
                <form action="{{ route('login.store') }}" method="POST" class="p-5 border rounded shadow bg-white">
                    @csrf

                    <h1 class="text-center mb-4">Вход</h1>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="8">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <x-form-item>
                        <x-checkbox name="remember" :checked="!! old('remember')">
                            {{__('Запомнить меня')}}
                        </x-checkbox>
                        <x-error name="remember"/>
                    </x-form-item>

                    <div class="text-left mt-3">
                        <a href="{{ route('password-email') }}">Забыли пароль?</a>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">Вход</button>

                </form>
            </div>
        </div>
    </div>

@endsection


