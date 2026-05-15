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
                            <span>
                                @if($comment->created_at->diffInHours() < 24)
                                    {{ $comment->created_at->diffForHumans() }}
                                @else
                                    {{ $comment->created_at->translatedFormat('d M H:i') }}
                                @endif
                            </span>
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
</div>
