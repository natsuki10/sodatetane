<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('そだてたねとは') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="ml-3">
                        <h2 class="text-xl text-green-700 font-bold mb-4 ml-4">そだてたねとは？</h2>
                        <div class="border-l-4 border-green-300 pl-2">
                            <p>保育での制作遊びのアイディア探しに困っていませんか？</p>
                            <p>制作遊びの試作の写真、手元にありませんか？</p>
                            <p>そだてたねとは忙しい保育士さんのためのアイディア共有アプリです。</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h2 class="text-xl text-green-700 font-bold mb-4 ml-7">ルール</h2>
                        <div class="border-l-4 border-green-300 ml-3 pl-2">
                            <h3 class="font-bold">--禁止事項--</h3>
                            <p>・こどもの顔や名前が特定できる投稿</p>
                            <p>・著作権侵害または知的財産権の侵害</p>
                            <p>・ヘイトスピーチや差別</p>
                            <p>・スパムや詐欺</p>
                            <p>・違法行為の促進または描写</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
