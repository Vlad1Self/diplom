<x-card>
    <x-card-body>
        <h2 class="h6">
            <a href="{{ route ('user.posts.show', $post -> id) }}">
                {{ $post -> title }}
            </a>
        </h2>

        <p>
            {!!$post->content!!}
        </p>
    </x-card-body>
</x-card>
