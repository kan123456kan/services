<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form name="edit-post-form" id="edit-post-form" method="post" action="{{ route('admin.editPost', $post->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select id="author_id" name="author_id" class="form-control" required>
                            <option value="{{ $post->author_id }}" selected>{{ $post->author->name }}</option>
                            @foreach($users as $user)
                                @if($user->id !== $post->author_id)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="blog_id">Blog</label>
                        <select id="blog_id" name="blog_id" class="form-control" required>
                            <option value="{{ $post->blog_id }}" selected>{{ $post->blog->title }}</option>
                            @foreach($blogs as $blog)
                                @if($blog->id !== $post->blog_id)
                                    <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="body" name="body" class="form-control" required>{{ $post->body }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="is_published">Is Published</label>
                        <input type="checkbox" id="is_published" name="is_published" value="1" {{ $post->is_published ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="likes">Likes</label>
                        <input type="number" id="likes" name="likes" class="form-control" value="{{ $post->likes }}" required>
                    </div>
                    <div class="form-group">
                        <label for="views">Views</label>
                        <input type="number" id="views" name="views" class="form-control" value="{{ $post->views }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
