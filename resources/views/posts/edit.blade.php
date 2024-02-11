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
                    <form method="POST" action="{{ route('posts.update', $post) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label for="material">材料</label>
                            <input type="text" class="form-control" id="material" name="material" value="{{ $post->material }}">
                        </div>

                        <!-- 対象年齢のチェックボックスを選択済みにする -->
                        @php
                            $targetAges = json_decode($post->target_age, true);
                        @endphp
                        <div class="form-group">
                            <label for="target_age">対象年齢</label>
                            <div class="form-group">
                                @foreach(range(0, 6) as $age)
                                    <input type="checkbox" id="age{{ $age }}" name="target_age[]" value="{{ $age }}"
                                        {{ in_array($age, $targetAges) ? 'checked' : '' }}>
                                    <label for="age{{ $age }}">{{ $age }}歳</label><br>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post_text">コメント</label>
                            <textarea class="form-control" id="post_text" name="post_text">{{ $post->post_text }}</textarea>                            <button type="submit">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
