<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  @foreach ($posts as $post)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <!-- Image -->
    <a href="{{ route('posts.show', $post->id) }}" class="block hover:bg-gray-100">
      @if ($post->image_url)
        <img src="{{ $post->image_url }}" alt="投稿画像" class="w-full h-auto sm:h-48 object-cover">
      @endif
      
      <!-- Content -->
    <a href="{{ route('posts.show', $post->id) }}" class="block hover:bg-gray-100">
      <div class="p-4">
        <h3 class="font-bold text-lg mb-2">{{ $post->title }}</h3>
        <p class="text-gray-600 text-sm">by: {{ $post->user->name }}</p>
        <p class="text-gray-600 text-sm">材料：{{ $post->material }}</p>
        
        <!-- Ages -->
        @php
            $decodedAges = json_decode($post->target_age, true);
        @endphp
        @if(is_array($decodedAges))
          <p class="text-gray-600 text-sm">対象年齢: {{ implode('歳 ', $decodedAges) }}歳</p>
        @endif
        
        <!-- Text -->
        <p class="text-gray-700 mt-2">{{ Str::limit($post->post_text, 60, '...') }}</p>
    </a>

        <!-- Meta -->
        <div class="mt-4 flex items-center justify-between">
          <span class="text-sm text-gray-600">{{ $post->created_at->format('Y-m-d H:i:s') }}</span>
          <!-- Like Button -->
          <div class="button flex flex-row my-8">
          <div class="like-button flex items-center mr-4">
            @if (Auth::check())
                <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center">
                        <img src="{{ asset('storage/icons/ハート.svg') }}" alt="heart" class="w-5 h-5 mr-2">
                        {{ $post->likes->count() }}
                    </button>
                </form>
            @endif
          </div>
          <!-- Comment Icon -->
           <div class="comment-icon flex items-center">
            <a href="{{ route('posts.show', $post->id) }}" class="flex items-center hover:bg-gray-100">
                <img src="{{ asset('storage/icons/吹き出し.svg') }}" alt="Comment" class="w-6 h-6 mr-2">
                {{ $post->comments->count() }}
            </a>          
          </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
</a>
<div class="flex justify-center items-center mt-4">{{ $posts->links() }}</div>
