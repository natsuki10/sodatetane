<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('いいねした投稿') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- いいねした投稿 -->
                    @if($likes->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($likes as $like)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Image -->
                        <a href="{{ route('posts.show', $like->post->id) }}" class="block hover:bg-gray-100">
                            @if ($like->post->image_url)
                            <img src="{{ $like->post->image_url }}" alt="投稿画像" class="w-full h-auto sm:h-48 object-cover">
                            @endif
                        </a>

                        <!-- Content -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $like->post->title }}</h3>
                            <p class="text-gray-600 text-sm">by: {{ $like->post->user->name }}</p>
                            <p class="text-gray-600 text-sm">材料：{{ $like->post->material }}</p>

                            <!-- Ages -->
                            @php
                            $decodedAges = json_decode($like->post->target_age, true);
                            @endphp
                            @if(is_array($decodedAges))
                            <p class="text-gray-600 text-sm">対象年齢: {{ implode('歳, ', $decodedAges) }}歳</p>
                            @endif

                            <!-- Text -->
                            <p class="text-gray-700 mt-2">{{ Str::limit($like->post->post_text, 60, '...') }}</p>
                        </div>

                        <!-- Meta -->
                        <div class="mt-4 flex items-center justify-between p-4">
                            <span class="text-sm text-gray-600">{{ $like->post->created_at->format('Y-m-d H:i:s') }}</span>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    <div class="flex justify-center items-center mt-4">
                        {{ $likes->links() }}
                    </div>
                    @else
                        <p>いいねした投稿がありません。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
