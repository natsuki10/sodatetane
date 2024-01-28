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
                    <p>{{ $post->material }}</p>
                    <p>対象年齢: 
                        @foreach(json_decode($post->target_age) as $age)
                            {{ $age }}歳
                        @endforeach
                    </p>
                    <p>投稿内容: {{ $post->post_text }}</p>
                    <p>投稿者: {{ $post->user->name }}</p>
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
