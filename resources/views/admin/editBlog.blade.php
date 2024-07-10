<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form name="edit-blog-form" id="edit-blog-form" method="post" action="{{ route('admin.editBlog', $blog->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $blog->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" required>{{ $blog->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="owner_id">Owner</label>
                        <select id="owner_id" name="owner_id" class="form-control" required>
                            <option value="{{ $blog->owner_id }}" selected>{{ $blog->owner->name }}</option>
                            @foreach($users as $user)
                                @if($user->id !== $blog->owner_id)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
