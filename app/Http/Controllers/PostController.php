<?php
namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'material' => 'required|max:255',
            'image' => 'required|image', // 画像が必須であることを確認
        ]);

        // 画像のアップロードとURLの取得
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = ''; // 画像がアップロードされなかった場合のデフォルト値
        }

        // 投稿データの保存
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $validatedData['title'];
        $post->material = $validatedData['material'];
        $post->target_age = json_encode($request->input('target_age')); // target_age が配列の場合、JSONにエンコード
        $post->post_text = $request->input('post_text');
        $post->image_url = $imageUrl;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

        // 投稿データと画像URLの保存
        // Post::create([
        //     'title' => $request->title,
        //     'material' => $request->material,
        //     'post_text' => $request->post_text,
        //     'image_url' => $imageUrl,
        //     'user_id' => auth()->id(),
        // ]);
        
    

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
