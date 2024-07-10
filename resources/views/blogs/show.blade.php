<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Details') }}
        </h2>
    </x-slot>

    <div class="container py-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-semibold mb-4">{{ $blog->title }}</h1>
                <p class="text-lg text-gray-700 mb-6">{{ $blog->description }}</p>
                <div class="flex items-center mb-4">
                    <span class="text-sm text-gray-600">Authors:</span>
                    <ul class="ml-2">
                        <li class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $blog->owner->name }}</li>
                    </ul>
                </div>
                <div class="flex mb-4">
                    <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary mr-2">Edit Blog</a>
                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Blog</button>
                    </form>
                    <a href="{{ route('posts.create') }}" class="btn btn-success ml-auto">Create Post</a>
                </div>
                <hr class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Posts:</h2>
                @foreach ($blog->posts as $post)
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <h3 class="text-xl font-semibold mb-2"><a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">{{ $post->title }}</a></h3>
                        <p class="text-gray-700">{{ $post->excerpt }}</p>
                        <div class="flex items-center mt-4">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">View Post</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
