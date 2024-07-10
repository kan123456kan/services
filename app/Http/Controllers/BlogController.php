<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhereHas('owner', function($q) use ($search) {
                      $q->where('owner_id', 'like', "%{$search}%");
                  });
        }

        if ($startDate = $request->input('start_date')) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate = $request->input('end_date')) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        $blogs = $query->orderBy($sort, $order)->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $data['owner_id'] = auth()->id();
        Blog::create($data);

        return redirect()->route('blogs.index');
    }

    public function show(Blog $blog)
    {
        $users = User::all();
        return view('blogs.show', compact('blog', 'users'));
    }

    public function edit(Blog $blog)
    {
        if ($blog->owner_id !== auth()->id() && !$blog->authors->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        if ($blog->owner_id !== auth()->id() && !$blog->authors->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $blog->update($data);

        return redirect()->route('blogs.index');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->owner_id !== auth()->id() && !$blog->authors->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $blog->posts()->each(function ($post) {
            $post->likes()->delete();
            $post->delete();
        });

        $blog->delete();

        return redirect()->route('blogs.index');
    }

    public function subscriptions()
    {
        $user = auth()->user();
        $blogs = $user->subscriptions()->with('blog')->paginate(10);
        return view('blogs.subscriptions', compact('blogs'));
    }

    public function addAuthor(Request $request, Blog $blog)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->id() !== $blog->owner_id && !$blog->authors->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'author_id' => 'required|exists:users,id',
        ]);

        $blog->authors()->attach($data['author_id']);

        return redirect()->route('blogs.show', $blog);
    }

    public function removeAuthor(Blog $blog, $authorId)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->id() !== $blog->owner_id && !$blog->authors->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $blog->authors()->detach($authorId);

        return redirect()->route('blogs.show', $blog);
    }
}
