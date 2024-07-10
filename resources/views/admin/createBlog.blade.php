<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form name="create-blog-form" id="create-blog-form" method="post" action="{{ route('admin.storeBlog') }}">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="owner_id">Owner</label>
                        <select id="owner_id" name="owner_id" class="form-control" required>
                            <option value="">Select Owner</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
