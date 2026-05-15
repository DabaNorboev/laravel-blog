<div class="pb-6">
    <div class="flex items-center justify-between mb-3 pt-3">
        <!-- Категория и теги -->
        <div class="flex items-center gap-4">
                        <span class="inline-block px-4 py-1.5 bg-gray-100 text-gray-700 text-sm rounded-lg uppercase tracking-wider">
                            {{ $post->category->title }}
                        </span>

            <div class="flex items-center gap-3">
                @foreach($post->tags as $tag)
                    <span class="inline-block text-gray-600 text-sm">
                                #{{ $tag->title }}
                            </span>
                @endforeach
            </div>
        </div>

        <!-- Дата -->
        <div class="text-gray-500 text-sm">
            @if($post->created_at->diffInHours() < 24)
                {{ $post->created_at->diffForHumans() }}
            @else
                {{ $post->created_at->translatedFormat('d M H:i') }}
            @endif
        </div>
    </div>

    <!-- Автор поста (ДОБАВЛЕНО) -->
    <div class="flex items-center mb-4">
        <x-user-avatar :user="$post->user->name"/>
        <div class="ps-2">
            <div class="text-gray-800 font-medium">
                <a href="{{ route('users.show', $post->user) }}">
                    {{ $post->user->name ?? 'Автор' }}
                </a>

            </div>
            <div class="text-gray-500 text-sm">
                Автор поста
            </div>
        </div>
    </div>

    <!-- Заголовок поста -->
    <h1 class="text-3xl font-light py-2 text-gray-800">
        {{$post->title}}
    </h1>
</div>

<!-- Изображение поста -->
<div class="mb-8">
    <div class="w-full h-80 bg-gray-100 rounded-lg overflow-hidden">
        @if($post->image)
            <img src="{{ $post->image }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                <div class="text-center">
                    <div class="text-gray-400 mb-2">
                        Изображение
                    </div>
                    <p class="text-gray-500 text-sm">Изображение отсутствует</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Контент поста -->
<div class="prose max-w-none mb-8">
    <div class="text-gray-700 leading-relaxed text-lg">
        {{ $post->content }}
    </div>
</div>
