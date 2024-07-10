<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.storeComment') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="post_id">Post</label>
                        <select class="form-control" id="post_id" name="post_id" required>
                            <option value="">Select Post</option>
                            @foreach($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select class="form-control" id="author_id" name="author_id" required>
                            <option value="">Select Author</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
