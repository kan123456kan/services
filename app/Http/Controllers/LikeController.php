<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $data['user_id'] = auth()->id();
        Like::create($data);

        return back();
    }

    public function destroy(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $like = Like::where('post_id', $data['post_id'])
            ->where('user_id', auth()->id())
            ->first();

        if ($like) {
            $like->delete();
        }

        return back();
    }
}