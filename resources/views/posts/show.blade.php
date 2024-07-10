<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>

        <h2 class="mt-5">Comments</h2>
        <div class="mb-4">
            @foreach ($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p>{{ $comment->body }}</p>
                        <p class="text-muted"><small>by {{ $comment->author->name }} on {{ $comment->created_at }}</small></p>
                        @if (auth()->id() == $comment->author_id)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mb-5">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <label for="body" class="form-label">Add a comment</label>
                    <textarea name="body" id="body" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endauth
    </div>
</x-app-layout>
