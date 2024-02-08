<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('投稿詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>{{ $post->title }}</h1>
                    <p>投稿者: {{ $post->user->name }}</p>
                    <p>{{ $post->material }}</p>
                    <p>対象年齢: 
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
                    <p>投稿内容: {{ $post->post_text }}</p>
                    @if ($post->image_url)
                            <img src="{{ $post->image_url }}" alt="投稿画像" class="post-image">
                        @endif
                    <p>投稿日時: {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
                @if(Auth::user() && Auth::user()->id === $post->user_id)
                    <a href="{{ route('posts.edit', $post) }}">編集</a>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
