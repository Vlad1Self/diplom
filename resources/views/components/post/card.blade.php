<x-card>
    <x-card-body>
        <h2 class="h6">
            <a href="{{ route ('shop.show', $post -> id) }}">
                {{ $post -> title }}
            </a>
        </h2>
        <img src="{{ asset("storage/$post->image_path") }}" class="img-fluid card-img-top" alt="">
        <div class="content-container">
            <p class="content-text">
                {!!$post->content!!}
            </p>
        </div>
        <p>
            <strong>{{ $post -> price }} ₽</strong>
        </p>
        <p class="btn-holder"><a href="{{ route('addbook.to.cart', $post->id) }}" class="btn btn-primary">Добавить в корзину</a> </p>
    </x-card-body>
</x-card>
