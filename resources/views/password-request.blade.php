@extends('layouts.main')

@section('content')

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-4">
                <form action="{{ route('password-email') }}" method="POST" class="p-5 border rounded shadow bg-white">
                    @csrf

                    <h1 class="text-center mb-4">Сбросить пароль</h1>

                    <div class="form-group mb-2">
                        <label for="email">Адрес электронной почты</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Отправить запрос на сброс пароля</button>

                </form>
            </div>
        </div>
    </div>

@endsection
