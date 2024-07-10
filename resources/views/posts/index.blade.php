<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search by title or author" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
                @if(request('search'))
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                </div>
                <div class="col-md-6">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="sort" class="form-label">Sort By</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                        <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Date (Oldest First)</option>
                        <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Date (Newest First)</option>
                        <option value="likes_asc" {{ request('sort') == 'likes_asc' ? 'selected' : '' }}>Likes (Fewest First)</option>
                        <option value="likes_desc" {{ request('sort') == 'likes_desc' ? 'selected' : '' }}>Likes (Most First)</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary" type="submit">Apply</button>
                </div>
            </div>
        </form>
        @foreach ($posts as $post)
            <div class="card post-card shadow-sm">
                <img src="https://via.placeholder.com/800x200" class="card-img-top post-img" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-primary text-decoration-none">{{ $post->title }}</a>
                    </h5>
                    <p class="card-text">{{ Str::limit($post->body, 150) }}</p>
                    <div class="post-meta d-flex justify-content-between align-items-center">
                        <div>
                            <span class="me-3"><i class="bi bi-heart-fill text-danger"></i> {{ $post->likes()->count() }}</span>
                            <span class="me-3"><i class="bi bi-eye-fill"></i> {{ $post->views }}</span>
                        </div>
                        <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="post-actions mt-3 d-flex justify-content-between align-items-center">
                        @if ($post->isLikedBy(auth()->id()))
                            <form action="{{ route('likes.destroy', ['post_id' => $post->id]) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Unlike</button>
                            </form>
                        @else
                            <form action="{{ route('likes.store') }}" method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">Like</button>
                            </form>
                        @endif
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary btn-sm">View Post</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>

<style>
    .post-card {
        margin-bottom: 1.5rem;
    }
    .post-img {
        height: 200px;
        object-fit: cover;
    }
    .post-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .post-actions {
        font-size: 0.9rem;
    }
</style>
