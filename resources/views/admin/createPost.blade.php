<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form name="create-post-form" id="create-post-form" method="post" action="{{ route('admin.storePost') }}">
                    @csrf

                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select id="author_id" name="author_id" class="form-control" required>
                            <option value="">Select Author</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="blog_id">Blog</label>
                        <select id="blog_id" name="blog_id" class="form-control" required>
                            <option value="">Select Blog</option>
                            @foreach($blogs as $blog)
                                <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="body" name="body" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="is_published">Is Published</label>
                        <input type="checkbox" id="is_published" name="is_published" value="1">
                    </div>

                    <div class="form-group">
                        <label for="likes">Likes</label>
                        <input type="number" id="likes" name="likes" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="views">Views</label>
                        <input type="number" id="views" name="views" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
