@extends('layouts.main')

@section('content')

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-4">
                <form action="{{ route('password-email-reset', $token) }}" method="POST" class="p-5 border rounded shadow bg-white">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <h1 class="text-center mb-4">Сбросить пароль</h1>

                    <div class="form-group mb-2">
                        <label for="new_password">Новый пароль</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required minlength="8">
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="new_password_confirmation">Подтверждение нового пароля</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Сохранить изменения</button>

                </form>
            </div>
        </div>
    </div>

@endsection
