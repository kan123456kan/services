<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="title" class="block text-gray-700">Title:</label>
                            <input type="text" class="form-control w-full" id="title" name="title" value="{{ $post->title }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="body" class="block text-gray-700">Body:</label>
                            <textarea class="form-control w-full" id="body" name="body" rows="8" required>{{ $post->body }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
