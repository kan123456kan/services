<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminConroller extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        $posts = Post::all();
        $comments = Comment::all();
        return view('admin.index', compact('blogs', 'posts', 'comments'));
    }

    // Post
    public function createPost()
    {
        $users = User::all();
        $blogs = Blog::all();
        return view('admin.createPost', compact('users', 'blogs'));
    }

    public function storePost(Request $request) {
        $validatedData = $request->validate([
            'author_id' => 'required|integer',
            'blog_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'is_published' => 'boolean',
            'likes' => 'nullable|integer',
            'views' => 'nullable|integer',
        ]);

        $post = new Post($validatedData);
        $post->save();

        return redirect()->route('admin.index');
    }

    public function viewPost($id){
        $post = Post::findOrFail($id);
        $blogs = Blog::all();
        $users = User::all();
        return view('admin.editPost', compact('post','users','blogs'));
    }

    public function editPost(Request $request, $id) {
        $validatedData = $request->validate([
            'author_id' => 'required|integer',
            'blog_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'is_published' => 'boolean',
            'likes' => 'nullable|integer',
            'views' => 'nullable|integer',
        ]);

        $post = Post::findOrFail($id);

        $post->update($validatedData);

        return redirect()->route('admin.index');
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->likes()->delete();
        $post->comments()->delete();
        $post->delete();

        return redirect()->route('admin.index');
    }


    // Blog

    public function createBlog()
    {
        $users = User::all();
        return view('admin.createBlog', compact('users'));
    }

    public function storeBlog(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'owner_id' => 'required|integer',
        ]);

        $blog = new Blog($validatedData);
        $blog->save();

        return redirect()->route('admin.index');
    }

    public function viewBlog($id) {
        $blog = Blog::findOrFail($id);
        $users = User::all();
        return view('admin.editBlog', compact('blog','users'));
    }

    public function editBlog(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'owner_id' => 'required|integer',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update($validatedData);

        return redirect()->route('admin.index');
    }

    public function destroyBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin.index');
    }

    //comment
    public function createComment()
    {
        $posts = Post::all();
        $users = User::all();
        return view('admin.createComment', compact('posts', 'users'));
    }

    public function storeComment(Request $request) {
        $validatedData = $request->validate([
            'post_id' => 'required|integer',
            'author_id' => 'required|integer',
            'body' => 'required|string',
        ]);

        $comment = new Comment($validatedData);
        $comment->save();

        return redirect()->route('admin.index');
    }

    public function viewComment($id){
        $comment = Comment::findOrFail($id);
        $posts = Post::all();
        $users = User::all();
        return view('admin.editComment', compact('comment','users','posts'));
    }

    public function editComment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|integer',
            'author_id' => 'required|integer',
            'body' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validatedData);

        return redirect()->route('admin.index');
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.index');
    }
}
