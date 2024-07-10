<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card post-card shadow-sm mb-4">
                    <img src="https://via.placeholder.com/800x400" class="card-img-top post-img" alt="{{ $post->title }}">
                    <div class="card-body">
                        <h1 class="card-title">{{ $post->title }}</h1>
                        <p class="card-text">{{ $post->body }}</p>
                        <div class="post-meta d-flex justify-content-between align-items-center">
                            <div>
                                <span class="me-3"><i class="bi bi-heart-fill text-danger"></i> {{ $post->likes()->count() }}</span>
                                <span class="me-3"><i class="bi bi-eye-fill"></i> {{ $post->views }}</span>
                            </div>
                            <small class="text-muted">{{ $post->created_at }}</small>
                        </div>
                        <div class="post-author mt-3">
                            <p class="mb-0">Written by <strong>{{ $post->author->name }}</strong></p>
                        </div>
                    </div>
                </div>

                <div class="card comments-card shadow-sm">
                    <div class="card-header bg-light">
                        <h2 class="card-title mb-0">Comments</h2>
                    </div>
                    <div class="card-body">
                        <div class="comments-list">
                            @foreach ($post->comments as $comment)
                                <div class="comment mb-3">
                                    <div class="comment-content">
                                        <div class="comment-header">
                                            <h5 class="comment-author">{{ $comment->author->name }}</h5>
                                            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="comment-body">
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-3">
                            <textarea name="body" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .post-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .comments-card {
        background-color: #f8f9fa;
        border: none;
    }
    .comment {
        display: flex;
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .comment-avatar {
        flex: 0 0 auto;
        margin-right: 1rem;
    }
    .comment-content {
        flex: 1 1 auto;
    }
    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .comment-author {
        font-weight: 600;
        margin-bottom: 0;
    }
    .comment-date {
        font-size: 0.875rem;
        color: #6c757d;
    }
    .comment-body {
        margin-bottom: 0;
    }
    .post-author {
        border-top: 1px solid #dee2e6;
        padding-top: 1rem;
        margin-top: 1rem;
    }
</style>
