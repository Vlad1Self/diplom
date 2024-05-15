@extends('shop')

@section('content')

    <div class="row">
        @foreach($books as $book)
            <div class="col-md-3 col-6 mb-4">
                <div class="card">
                    <img src="{{ asset("storage/$book->image_path") }}" class="card-img-top">
                    <div class="card-body">
                        <h4 class="card-title">{{ $book->title }}</h4>
                        <p>{{ $book->content }}</p>
                        <p class="card-text"><strong>Цена: </strong> ${{ $book->price }}</p>
                        <p class="btn-holder"><a href="{{ route('addbook.to.cart', $book->id) }}" class="btn btn-outline-danger">Добавить в корзину</a> </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
