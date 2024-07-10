<?php

use App\Http\Controllers\Admin\AdminConroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/view', [AdminConroller::class, 'index'])->name('admin.index');

    // Post
    Route::get('/admin/create', [AdminConroller::class, 'createPost'])->name('admin.createPost');
    Route::post('/admin/store', [AdminConroller::class, 'storePost'])->name('admin.storePost');
    Route::get('/admin/edit/{viewPost}', [AdminConroller::class, 'viewPost'])->name('admin.viewPost');
    Route::post('/admin/updatePost/{id}', [AdminConroller::class, 'editPost'])->name('admin.editPost');
    Route::delete('/admin/post/{postId}', [AdminConroller::class, 'destroyPost'])->name('admin.destroyPost');

    // Blog
    Route::get('/admin/create/blog', [AdminConroller::class, 'createBlog'])->name('admin.createBlog');
    Route::post('/admin/store/blog', [AdminConroller::class, 'storeBlog'])->name('admin.storeBlog');
    Route::get('/admin/editBlog/{viewBlog}', [AdminConroller::class, 'viewBlog'])->name('admin.viewBlog');
    Route::post('/admin/updateBlog/{id}', [AdminConroller::class, 'editBlog'])->name('admin.editBlog');
    Route::delete('/admin/blog/{blogId}', [AdminConroller::class, 'destroyBlog'])->name('admin.destroyBlog');

    //comment
    Route::get('/create-comment', [AdminConroller::class, 'createComment'])->name('admin.createComment');
    Route::post('/store-comment', [AdminConroller::class, 'storeComment'])->name('admin.storeComment');
    Route::get('/edit-comment/{id}', [AdminConroller::class, 'viewComment'])->name('admin.viewComment');
    Route::post('/edit-comment/{id}', [AdminConroller::class, 'editComment'])->name('admin.editComment');
    Route::delete('/delete-comment/{id}', [AdminConroller::class, 'destroyComment'])->name('admin.destroyComment');
});

// Blog
Route::middleware('auth')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::post('/blogs/{blog}/add-author', [BlogController::class, 'addAuthor'])->name('blogs.addAuthor');
});

// Post
Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/my-posts', [PostController::class, 'userPosts'])->name('posts.user');
});

// Comment
Route::middleware('auth')->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Subscription
Route::middleware('auth')->group(function () {
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::delete('/subscriptions/{blog}', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
});

//likes
Route::middleware('auth')->group(function () {
    Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
});


require __DIR__ . '/auth.php';