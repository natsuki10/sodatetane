<?php
namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index(Request $request)
{
    $query = Post::query();
    $posts = Post::orderBy('created_at', 'desc')->paginate(6);
    return view('posts.index', compact('posts'));

    // キーワード検索
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('post_text', 'like', '%' . $request->search . '%');
        });
    }

    // 対象年齢の検索 jsonの問題が解決しないため、暫定対応をする
    // if ($request->filled('target_age')) {
    //     $query->where(function ($q) use ($request) {
    //         foreach ($request->target_age as $age) {
    //             $q->orWhereJsonContains('target_age', "\"$age\"");            }
    //     });
    // }
    if ($request->filled('target_age')) {
        $query->where(function ($q) use ($request) {
            foreach ($request->target_age as $age) {
                // LIKE演算子を使用して暫定的な検索を行う
                $agePattern = '%"'.$age.'"%'; // JSON配列内の文字列としての年齢を模倣
                $q->orWhere('target_age', 'LIKE', $agePattern);
            }
        });
    }

    $posts = $query->orderByDesc('created_at')->get();

    return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function myPosts()
    {
    $userId = Auth::id(); // 現在認証されているユーザーのIDを取得
    $posts = Post::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10); // ユーザーIDに基づいて投稿を取得

    return view('posts.my_posts', compact('posts')); // ビューに投稿を渡す
    }

    public function store(Request $request)
    {
        Log::info('Received new post request', $request->all());
        
        // 画像のアップロードとURLの取得
        $imageUrl = null;
        if ($request->hasFile('image')) {
            Log::info('Image file received.');
            $imagePath = $request->file('image')->store('images', 'public');
            $imageUrl = Storage::url($imagePath);
            Log::info('Image stored: ' . $imageUrl);
        } else {
            Log::info('No image file received.');
        }
        

        // 投稿データの保存
        try {
            $post = new Post;
            $post->user_id = Auth::id();
            $post->title = $request->input('title');
            $post->material = $request->input('material');
            $post->target_age = json_encode($request->input('target_age'));
            $post->post_text = $request->input('post_text');
            // 画像の処理が成功した後、$imageUrlに適切な値がセットされていることを確認
            $post->image_url = $imageUrl ?? null; // 画像がない場合はnullを設定
            $post->save();
        
            Log::info('Post saved successfully', ['post_id' => $post->id]);
            return redirect()->route('posts.index')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            Log::error('Error saving post', ['error' => $e->getMessage()]);
            // エラー発生時は、ユーザーにフィードバックを提供
            return back()->withErrors('Error saving the post. Please try again.')->withInput();
        }
        
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'material' => 'required|max:255',
            'post_text' => 'required',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post)->with('success', '投稿が更新されました！');
    }
    
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', '投稿が削除されました！');
    }

    public function show($id)
    {
        $post = Post::with('comments.user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

}
