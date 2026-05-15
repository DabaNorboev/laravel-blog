@foreach($posts as $post)
    <div class="border-t border-gray-300 px-4 py-6 flex gap-4 h-64">
        <div class="date text-gray-500 w-[15%] flex flex-col justify-center">
            <!-- Категория -->
            <div class="mb-4">
                <span class="inline-block px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-lg uppercase tracking-wider">
                    {{ $post->category->title }}
                </span>
            </div>
            <!-- Дата -->
            <div>
                <p class="font-light text-gray-800">
                    @if($post->created_at->diffInHours() < 24)
                        {{ $post->created_at->diffForHumans() }}
                    @else
                        {{ $post->created_at->translatedFormat('d M H:i') }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Пост с тегами сверху -->
        <div class="post w-[60%] flex flex-col justify-center">
            <!-- Теги -->
            <div class="mb-3 flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <span class="inline-block px-0 py-1 text-gray-600 text-sm">
                                    #{{ $tag->title }}
                                </span>
                @endforeach
            </div>

            <a href="{{ route('posts.show', $post) }}">
                <!-- Заголовок и текст -->
                <h2 class="text-xl line-clamp-2 mb-3">
                    {{ $post->title }}
                </h2>

                <p class="text-gray-600 line-clamp-3">
                    {{ $post->content }}
                </p>
            </a>

        </div>

        <!-- Изображение -->
        <div class="img w-[25%] h-full">
            <div class="w-full h-full bg-gray-100 rounded-lg overflow-hidden">
                <!-- Заглушка -->
                <div class="w-full h-full flex items-center justify-center bg-gray-100 rounded-lg">
                    <div class="text-center">
                        <p class="text-gray-500 text-sm">Нет фото</p>
                        <p class="text-gray-500 text-sm">({{ $post->image }})</p>
                    </div>
                </div>
                {{--                            <!-- Реальное изображение (раскомментировать когда будет) -->--}}
                {{--                            <img src="{{ $post->image }}"--}}
                {{--                                alt="post photo" class="w-full h-full object-cover" loading="lazy"--}}
                {{--                            >--}}
            </div>
        </div>
    </div>
@endforeach
