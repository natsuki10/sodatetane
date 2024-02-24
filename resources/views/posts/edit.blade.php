<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('投稿編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <h1>投稿編集</h1>

                            <div class="form-group">
                                <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>

                            <div class="form-group">
                                <label for="material" class="leading-7 text-sm text-gray-600">材料</label>
                                <input type="text" id="material" name="material" value="{{ old('material', $post->material) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>

                            <div class="form-group">
                                <label for="target_age" class="leading-7 text-sm text-gray-600">対象年齢</label>
                                <div class="flex justify-center items-center gap-1">
                                    @foreach(range(0, 6) as $age)
                                        <input type="checkbox" id="age{{ $age }}" name="target_age[]" value="{{ $age }}" {{ in_array($age, json_decode($post->target_age, true) ?? []) ? 'checked' : '' }}>
                                        <label for="age{{ $age }}">{{ $age }}歳</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="post_text" class="leading-7 text-sm text-gray-600">コメント</label>
                                <textarea id="post_text" name="post_text" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('post_text', $post->post_text) }}</textarea>
                            </div>

                            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>