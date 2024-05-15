<x-card>
    <x-card-body>
        <h2 class="h6">
            <a href="{{ route ('shop.show', $post -> id) }}">
                {{ $post -> title }}
            </a>
        </h2>
        <img src="{{ asset("storage/$post->image_path") }}" class="img-fluid" alt="">
        <p>
            <strong>{{ $post -> price }} ₽</strong>
        </p>
        <p>
            {!!$post->content!!}
        </p>
        <p class="btn-holder"><a href="{{ route('addbook.to.cart', $post->id) }}" class="btn btn-outline-danger">Добавить в корзину</a> </p>
    </x-card-body>
</x-card>
