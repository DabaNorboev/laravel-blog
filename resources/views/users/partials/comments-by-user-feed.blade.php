<div id="comments-content" class="tab-content hidden">
    <div class="space-y-4">
        @forelse($user->comments as $comment)
            <div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                <div class="flex flex-col">
                    <!-- Заголовок статьи, к которой комментарий -->
                    <div class="mb-2">
                        <a href="{{ route('posts.show', $comment->post) }}"
                           class="text-gray-700 hover:text-blue-600 font-medium text-sm">
                            {{ $comment->post->title }}
                        </a>
                    </div>

                    <!-- Текст комментария -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-2">
                        <p class="text-gray-800">{{ $comment->message }}</p>
                    </div>

                    <!-- Мета-информация -->
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center gap-3">
                            <span>{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                            @if($comment->likes()->count() > 0)
                                <span>👍 {{ $comment->likes()->count() }}</span>
                            @endif
                        </div>

                        <a href="{{ route('posts.show', $comment->post) }}#comment-{{ $comment->id }}"
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            Перейти к комментарию →
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-gray-500">У пользователя пока нет комментариев</p>
            </div>
        @endforelse
    </div>

    @if($user->comments_count > 10)
        <div class="mt-6 text-center">
            <a href="{{ route('user.comments', $user) }}"
               class="inline-block px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Показать все комментарии
            </a>
        </div>
    @endif
</div>
