<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
{
    $like = $post->likes()->where('user_id', Auth::id())->first();
    if ($like) {
        $like->delete();
    } else {
        $post->likes()->create([
            'user_id' => Auth::id(),
        ]);
    }

    return back();
}

public function index()
{
    $userId = Auth::id(); 
    $likes = Like::where('user_id', $userId)->with('post')->paginate(10); 

    return view('posts.likes.index', compact('likes'));
}

}
