<?php
namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::orderByDesc('created_at')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'material' => 'required|max:255'          
        ]);

        $targetAges = $request->input('target_age');


        $post = new Post($validatedData);
        $post->user_id = Auth::id(); // ユーザーIDの設定
        $post->title = $request->input('title');
        $post->target_age = json_encode($request->input('target_age'));
        $post->post_text = $request->input('post_text');

        $post->save();
        // dd($request->all());

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'material' => 'required|max:255'
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post)->with('success', '投稿が更新されました！');
    }
    
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', '投稿が削除されました！');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

}
