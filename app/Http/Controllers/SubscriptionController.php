<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $data['user_id'] = auth()->id();
        Subscription::create($data);

        return back();
    }

    public function destroy(Blog $blog)
    {
        $subscription = Subscription::where('user_id', auth()->id())
                                    ->where('blog_id', $blog->id)
                                    ->first();

        if ($subscription) {
            $subscription->delete();
        }

        return back();
    }

    public function index()
    {
        $subscriptions = auth()->user()->subscriptions()->with('blog')->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }
}
