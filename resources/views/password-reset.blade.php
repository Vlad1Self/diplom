@extends('layouts.main')

@section('content')

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-4">
                <form action="{{ route('password-reset') }}" method="POST" class="p-5 border rounded shadow bg-white">
                    @csrf

                    <h1 class="text-center mb-4">Изменить пароль</h1>

                    <div class="form-group mb-2">
                        <label for="current_password">Текущий пароль</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required autofocus>
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Отправить письмо для подтверждения</button>

                </form>
            </div>
        </div>
    </div>

@endsection
