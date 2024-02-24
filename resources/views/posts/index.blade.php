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
                    <div class="mb-6">
                        <form action="{{ route('posts.index') }}" method="GET">
                            <div>
                                <input type="text" name="search" placeholder="キーワード検索">
                            </div>
                            <div class="flex">
                            <div>
                                対象年齢:
                                @foreach(range(0, 6) as $age)
                                    <input type="checkbox" name="target_age[]" value="{{ $age }}"> {{ $age }}歳
                                @endforeach
                            </div>
                            <button class="ml-5 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400">
                            <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                検索
                            </span>                            
                        </div>
                        </form>
                    </div>

                    <!-- 投稿 -->
                    <x-post-card :posts="$posts" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/like-push.js') }}"></script>

