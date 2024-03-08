<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('AIに相談') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <label for="chat-title">ChatGPTに聞いてみる</label>
                <form method="POST" action="{{ route('chat_gpt-chat') }}">
                    @csrf
                    <textarea class="resize-none rounded-md w-full"
                    placeholder="例.1歳児の4月制作アイディアを2つ教えてください" name="sentence">{{ isset($sentence) ? $sentence : '' }}</textarea>
                    <p class="text-xs text text-red-500">AIが生成した内容には虚偽が含まれている可能性があります。</p>
                    <p class="text-xs text text-red-500">また、個人情報は入力しないでください。</p>
                    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded text-xs">送信</button>
                </form>
                </div>
                <div class="p-6 w-hull">
                <label for="answer">回答</label><br>
                {{ isset($chat_response) ? $chat_response : '' }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
