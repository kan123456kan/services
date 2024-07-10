<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QQ</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
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
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Posts') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                                    <span class="me-3"><i class="bi bi-heart-fill text-danger"></i> {{ $post->likes }}</span>
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
        </div>
    </div>
</x-app-layout>

</body>
</html>
