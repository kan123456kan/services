<x-app-layout>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('admin.createBlog') }}" class="btn btn-warning">Create blog</a>
            </div>
            <div class="col">
                <a href="{{ route('admin.createPost') }}" class="btn btn-warning">Create post</a>
            </div>
            <div class="col">
                <a href="{{ route('admin.createComment') }}" class="btn btn-warning">Create comment</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Blogs</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Owner ID</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->description }}</td>
                                    <td>{{ $blog->owner->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.viewBlog', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.destroyBlog', $blog->id)}}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Posts</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Author ID</th>
                                <th scope="col">Blog ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Is Published</th>
                                <th scope="col">Likes</th>
                                <th scope="col">Views</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->author->name }}</td>
                                    <td>{{ $post->blog->title }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>{{ $post->is_published }}</td>
                                    <td>{{ $post->likes }}</td>
                                    <td>{{ $post->views }}</td>
                                    <td>
                                        <a href="{{ route('admin.viewPost', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.destroyPost', $post->id)}}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Comments</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Post ID</th>
                                <th scope="col">Author ID</th>
                                <th scope="col">Body</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->post->title }}</td>
                                    <td>{{ $comment->author->name }}</td>
                                    <td>{{ $comment->body }}</td>
                                    <td>
                                        <a href="{{ route('admin.viewComment', $comment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.destroyComment', $comment->id)}}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
