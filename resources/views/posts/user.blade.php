<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <p>
                        <small class="text-muted">
                            Likes: {{ $post->likes }} |
                            Views: {{ $post->views }}
                        </small>
                    </p>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary mr-2">View Post</a>

                    @if (auth()->id() === $post->author_id)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary mr-2">Edit Post</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Post</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
