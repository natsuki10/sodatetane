<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment_text' => 'required|max:500', 
        ]);

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id();
        $comment->comment_text = $request->comment_text;
        $comment->save();

        return redirect()->route('posts.show', $postId)->with('success', 'コメントを投稿しました。');
    }
}
