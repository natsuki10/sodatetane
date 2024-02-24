<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="space-y-4">
        <h1>新規投稿</h1>

        <div class="form-group">
            <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
            <input type="text" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="material">材料</label>
            <input type="text" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="material" name="material" value="{{ old('material') }}">
        </div>

        <div class="form-group">
            <label for="target_age" class="leading-7 text-sm text-gray-600">対象年齢</label>
                <div class="flex justify-center items-center gap-1">
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
            <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
            <input type="file" class="form-control" id="image" name="image" style="display:none;">
            <div id="drop-area">
                <p>ファイルをドラッグ&ドロップまたは
                <span class="file-upload-link"><button class="flex mx-auto text-white bg-green-500 border-0 py-1 px-4 focus:outline-none hover:bg-green-700 rounded text-sm">選択</button></span></p>
            </div>                            
        </div>

        <div class="form-group">
            <label for="post_text" class="leading-7 text-sm text-gray-600">コメント</label>
            <textarea class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" id="post_text" name="post_text">{{ old('post_text') }}</textarea>
        </div>
        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿</button>
    </div>
</form>
<script src="{{ asset('js/drop-upload.js') }}"></script>

