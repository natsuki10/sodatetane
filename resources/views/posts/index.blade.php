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
                    @foreach ($posts as $post)
                    <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                        <div>by: {{ $post->user->name }}</div>
                        <div>{{ $post->material }}</div>
                        <p>{{ $post->post_text }}</p>
                        @if ($post->image_url)
                            <img src="{{ $post->image_url }}" alt="投稿画像" class="post-image">
                        @endif
                        <div>{{ $post->created_at->format('Y-m-d H:i:s') }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
