<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('投稿一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- 検索機能 -->
                    <form action="{{ route('posts.index') }}" method="GET">
                        <div>
                            <input type="text" name="search" placeholder="キーワード検索">
                        </div>
                        <div>
                            対象年齢:
                            @foreach(range(0, 6) as $age)
                                <input type="checkbox" name="target_age[]" value="{{ $age }}"> {{ $age }}歳
                            @endforeach
                        </div>
                        <button type="submit">検索</button>
                    </form>

                    <!-- 投稿 -->
                    @foreach ($posts as $post)
                    <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                        <div>by: {{ $post->user->name }}</div>
                        <div>{{ $post->material }}</div>
                        <!-- 対象年齢の表示 -->
                        @php
                            $decodedAges = json_decode($post->target_age, true);
                        @endphp
                        @if(is_array($decodedAges))
                            {{ implode('歳 ', $decodedAges) }}歳
                        @endif
                        <div>{{ $post->post_text }}</div>
                        @if ($post->image_url)
                            <img src="{{ $post->image_url }}" alt="投稿画像" class="post-image">
                        @endif
                        <div>{{ $post->created_at->format('Y-m-d H:i:s') }}</div>
                        <!-- いいねボタン -->
                        @if (Auth::check())
                            <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="like-button">{{ $post->likes->count() }}♡</button>
                            </form>
                        @else
                            <span>{{ $post->likes->count() }}♡</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/like-push.js') }}"></script>

