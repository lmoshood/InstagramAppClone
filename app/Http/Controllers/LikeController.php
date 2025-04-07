<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        // Check if user already liked the post
        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You already liked this post');
        }

        // Create new like
        $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Post liked!');
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', Auth::id())->delete();
        return back();
    }
}
