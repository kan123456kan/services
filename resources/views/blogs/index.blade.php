<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <form action="{{ route('blogs.index') }}" method="GET" class="mb-4">
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by title or author" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-control">
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="order" class="form-control">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Search</button>
            @if(request('search') || request('start_date') || request('end_date') || request('sort') || request('order'))
                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>

        <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-4">Create Blog</a>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4">
                    <div class="card blog-card shadow-sm">
                        <img src="https://via.placeholder.com/800x200" class="card-img-top blog-img" alt="{{ $blog->title }}">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('blogs.show', $blog) }}" class="text-primary text-decoration-none">{{ $blog->title }}</a>
                            </h5>
                            <p class="card-text">{{ Str::limit($blog->description, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-secondary btn-sm">View Blog</a>
                                @if ($blog->isSubscribedBy(auth()->user()))
                                    <form action="{{ route('subscriptions.destroy', $blog) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Unsubscribe</button>
                                    </form>
                                @else
                                    <form action="{{ route('subscriptions.store') }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Subscribe</button>
                                    </form>
                                @endif

                                @if ($blog->owner_id === auth()->id())
                                    <a href="{{ route('posts.create', ['blog' => $blog->id]) }}" class="btn btn-success btn-sm">Create Post</a>
                                    <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning btn-sm">Edit Blog</a>
                                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Blog</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</x-app-layout>

<style>
    .blog-card {
        margin-bottom: 1.5rem;
    }
    .blog-img {
        height: 200px;
        object-fit: cover;
    }
</style>
