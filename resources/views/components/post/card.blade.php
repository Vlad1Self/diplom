<x-card>
    <x-card-body>
        <h2 class="h6">
            <a href="{{ route ('shop.show', $post -> id) }}">
                {{ $post -> title }}
            </a>
        </h2>
        <img src="{{ asset("storage/$post->image_path") }}" class="img-fluid" alt="">
        <p>
            {{ $post -> price }} руб.
        </p>
        <p>
            {!!$post->content!!}
        </p>
    </x-card-body>
</x-card>
