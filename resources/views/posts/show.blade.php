<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('投稿詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-center">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container flex justify-between">
                        <div class="content-text basis-1/2">
                            <h1 class="text-2xl my-6">{{ $post->title }}</h1>
                            <p class="my-1">投稿者： {{ $post->user->name }}</p>
                            <p class="my-1">材料：{{ $post->material }}</p>
                            <p class="my-1">対象年齢：
                            @php
                            $targetAges = json_decode($post->target_age);
                            @endphp
                            @if($targetAges && is_array($targetAges))
                                @foreach($targetAges as $age)
                                    {{ $age }}歳
                                @endforeach
                            @else
                                対象年齢が存在していません
                            @endif
                            </p>
                            <p class="my-1">投稿内容：<br> {{ $post->post_text }}</p>
                            <p>投稿日時： {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                        <div class="image basis-1/2 mt-8">
                            @if ($post->image_url)
                                <img src="{{ $post->image_url }}" alt="投稿画像" class="post-image">
                            @endif
                        </div>
                    </div>

                    <!-- いいねボタン -->
                    <div class="like-button flex items-center mr-4">
                        @if (Auth::check())
                            <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center">
                                    <img src="{{ asset('storage/icons/ハート.svg') }}" alt="heart" class="w-5 h-5 mr-2">
                                    {{ $post->likes->count() }}
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- 編集削除 -->
                    <div class="button flex flex-row my-8">
                        @if(Auth::user() && Auth::user()->id === $post->user_id)
                            <div class="edit-button">
                                <a href="{{ route('posts.edit', $post) }}">                            
                                    <button type="submit" class="flex mx-auto text-xs text-white bg-green-300 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                        編集                            
                                    </button>
                                </a>
                            </div>
                            <div class="delete-button ml-2">
                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex mx-auto text-xs text-white bg-red-400 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">削除</button>
                            </form>
                            </div>
                        @endif
                    </div>

                    <!-- コメントフォーム -->
                    @auth
                    <label for="comment">コメント</label>
                    <form action="{{ route('comments.store', ['post' => $post->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="comment_text" class="form-control w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out placeholder="コメントを入力"></textarea>
                        <button type="submit" class="text-xs bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">コメント送信</button>
                    </form>
                    @endauth
                    <!-- コメント一覧 -->
                    <div class="comments mt-4">
                        <h3>コメント</h3>
                        @foreach($post->comments as $comment)
                            <div class="comment mb-2">
                                <strong>{{ $comment->user->name }}:</strong>
                                <p>{{ $comment->comment_text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
