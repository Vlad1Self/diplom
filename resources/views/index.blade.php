@extends('layouts.main')

@section('content')

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6">
                <form action="/checkout" method="POST" class="p-5 border rounded">
                    @csrf

                    <h1 class="text-center mb-4">Оформить заказ</h1>

                    <div class="form-group mb-2">
                        <label for="address">Адрес доставки (город, улица, дом)</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="entrance">Подъезд</label>
                        <input type="text" class="form-control @error('entrance') is-invalid @enderror" id="entrance" name="entrance" value="{{ old('entrance') }}">
                        @error('entrance')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="floor">Этаж</label>
                        <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor') }}">
                        @error('floor')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="apartment">Квартира</label>
                        <input type="text" class="form-control @error('apartment') is-invalid @enderror" id="apartment" name="apartment" value="{{ old('apartment') }}" required>
                        @error('apartment')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="comment">Комментарий к адресу</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment">{{ old('comment') }}</textarea>
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger btn-block">Оформить заказ и оплатить</button>
                </form>
            </div>
        </div>
    </div>

@endsection
