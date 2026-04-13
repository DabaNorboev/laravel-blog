<div class="mt-12 pt-8 border-t border-gray-200">
    <h2 class="text-2xl font-light text-gray-800 mb-8">
        Комментарии <span class="text-gray-500">({{ $post->comments->count() ?? 0 }})</span>
    </h2>

    <!-- Форма добавления комментария -->
    @include('posts.partials.create-comment-form')

    <!-- Список комментариев -->
    <div class="space-y-8">
        @if(empty($post->comments))
            <!-- Сообщение если комментариев нет -->
            <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-lg">
                <div class="text-gray-400 text-2xl mb-4">
                    Комментарии
                </div>
                <h3 class="text-lg font-medium text-gray-600 mb-2">Пока нет комментариев</h3>
                <p class="text-gray-500">Будьте первым, кто оставит комментарий!</p>
            </div>
        @else
            @foreach($post->comments as $comment)
                <!-- Пример комментария -->
                <div class="flex gap-4">
                    <!-- Аватар пользователя -->
                    <x-user-avatar :user="$comment->user->name" />

                    <!-- Контент комментария -->
                    <div class="flex-1">
                        <!-- Заголовок комментария -->
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <a href="{{ route('profile.show', $comment->user) }}">
                                    <span class="font-medium text-gray-800">{{ $comment->user->name }}</span>
                                </a>
                                <span class="text-gray-500 text-sm ml-3">5 часов назад</span>
                            </div>
                        </div>

                        <!-- Текст комментария -->
                        <div class="text-gray-700 mb-3">
                            <p>{{ $comment->message }}</p>
                        </div>

                        <!-- Действия с комментарием -->
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <form action="{{ route('like.toggle', ['type' => 'comment', 'id' => $comment->id]) }}" method="post">
                                @csrf
                                <button class="flex items-center gap-1 hover:text-gray-700 transition-colors">
                                    <span>{{ $comment->likes }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
