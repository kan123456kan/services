<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" id="body" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="blog_id" class="form-label">Blog</label>
                <select name="blog_id" id="blog_id" class="form-control" required>
                    @foreach ($blogs as $blog)
                        <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</x-app-layout>
