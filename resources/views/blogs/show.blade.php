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
                    <span class="text-sm text-gray-600">Owner:</span>
                    <ul class="ml-2">
                        <li class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $blog->owner->name }}</li>
                    </ul>
                </div>

                <div class="flex items-center mb-4">
                    <span class="text-sm text-gray-600">Authors:</span>
                    <ul class="ml-2">
                        @foreach ($blog->authors as $author)
                            <li class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $author->name }}</li>
                            @if ($blog->owner_id === auth()->id())
                            <form action="{{ route('blogs.removeAuthor', ['blog' => $blog, 'authorId' => $author->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-1">Remove</button>
                            </form>
                            @endif
                        @endforeach
                    </ul>
                </div>

                @if ($blog->owner_id === auth()->id())
                    <form action="{{ route('blogs.addAuthor', $blog) }}" method="POST">
                        @csrf
                        <label for="author_id">Add Author:</label>
                        <select name="author_id" id="author_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Add</button>
                    </form>
                @endif

                <hr class="my-6">

                <h2 class="text-2xl font-semibold mb-4">Posts:</h2>
                @foreach ($blog->posts as $post)
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <h3 class="text-xl font-semibold mb-2"><a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">{{ $post->title }}</a></h3>
                        <p class="text-gray-700">{{ $post->excerpt }}</p>
                        <div class="flex items-center mt-4">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">View Post</a>
                            @if ($blog->owner_id === auth()->id() || $blog->authors->contains(auth()->user()))
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-success ml-3">Edit Post</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
