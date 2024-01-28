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
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="material">材料</label>
                            <input type="text" class="form-control" id="material" name="material">
                        </div>
                        <div class="form-group">
                            <label for="target_age">対象年齢</label>
                            <div class="form-group">
                                <input type="checkbox" id="age0" name="target_age[]" value="0">
                                <label for="age0">0歳</label><br>

                                <input type="checkbox" id="age1" name="target_age[]" value="1">
                                <label for="age1">1歳</label><br>

                                <input type="checkbox" id="age2" name="target_age[]" value="2">
                                <label for="age2">2歳</label><br>

                                <input type="checkbox" id="age3" name="target_age[]" value="3">
                                <label for="age3">3歳</label><br>

                                <input type="checkbox" id="age4" name="target_age[]" value="4">
                                <label for="age4">4歳</label><br>

                                <input type="checkbox" id="age5" name="target_age[]" value="5">
                                <label for="age5">5歳</label><br>

                                <input type="checkbox" id="age6" name="target_age[]" value="6">
                                <label for="age6">6歳以上</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post_text">コメント</label>
                            <textarea class="form-control" id="post_text" name="post_text"></textarea><br>                      
                            <button type="submit">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
