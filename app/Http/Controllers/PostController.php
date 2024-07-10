<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function welcome()
    {
        $posts = Post::latest()->paginate(10);
        return view('welcome', compact('posts'));
    }
    public function index(Request $request)
    {
        $query = Post::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('author', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        if ($fromDate = $request->input('from_date')) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate = $request->input('to_date')) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        $sort = $request->input('sort', 'date_desc');

        switch ($sort) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'likes_asc':
                $query->withCount('likes')->orderBy('likes_count', 'asc');
                break;
            case 'likes_desc':
                $query->withCount('likes')->orderBy('likes_count', 'desc');
                break;
        }

        $posts = $query->paginate(10);
        return view('posts.index', compact('posts'));
    }



    public function create()
    {
        $blogs = Blog::all();
        return view('posts.create', compact('blogs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
            'is_published' => 'boolean'
        ]);

        $data['author_id'] = auth()->id();
        Post::create($data);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $post->increment('views');
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'is_published' => 'boolean'
        ]);

        $post->update($data);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }

    public function userPosts()
    {
        $posts = auth()->user()->posts()->latest()->paginate(10);
        return view('posts.user', compact('posts'));
    }
}
