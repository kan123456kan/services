<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.editComment', $comment->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="post_id">Post</label>
                        <select id="post_id" name="post_id" class="form-control" required>
                            <option value="{{ $comment->post_id }}" selected>{{ $comment->post->title }}</option>
                            @foreach($posts as $post)
                                @if($post->id !== $comment->post_id)
                                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select id="author_id" name="author_id" class="form-control" required>
                            <option value="{{ $comment->author_id }}" selected>{{ $comment->author->name }}</option>
                            @foreach($users as $user)
                                @if($user->id !== $comment->author_id)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="4" required>{{ $comment->body }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
