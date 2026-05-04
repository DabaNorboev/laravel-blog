<div id="likes-content" class="tab-content hidden">
    <div class="space-y-6">
        <!-- Лайки на статьи -->
        @if($user->likes->isNotEmpty())
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Понравившиеся статьи ({{ $user->likes_count }})</h3>
                <div class="space-y-4">
                    @foreach($user->likes as $likedPost)
                        <div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="text-gray-900 font-medium mb-1">
                                        <a href="{{ route('posts.show', $likedPost) }}" class="hover:text-blue-600">
                                            {{ $likedPost->title }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center gap-3 text-gray-500 text-sm mb-2">
                                        <span>Автор: {{ $likedPost->user->name }}</span>
                                        <span>{{ $likedPost->created_at->format('d.m.Y') }}</span>
                                        <span>👁 {{ $likedPost->views }}</span>
                                        <span>👍 {{ $likedPost->likes()->count() }}</span>
                                        <span>💬 {{ $likedPost->comments()->count() }}</span>
                                    </div>
                                    @if($likedPost->excerpt)
                                        <p class="text-gray-600 text-sm line-clamp-2">{{ $likedPost->excerpt }}</p>
                                    @endif
                                </div>

                                <div class="ml-4 flex flex-col items-end gap-2">
                                    <a href="{{ route('posts.show', $likedPost) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium whitespace-nowrap">
                                        Читать →
                                    </a>
                                    <span class="text-gray-500 text-xs">
                                                Лайк поставлен: {{ $likedPost->created_at->format('d.m.Y H:i') }}
                                            </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($user->posts_likes_count > 10)
                    <div class="mt-4 text-center">
                        <a href="{{ route('user.liked-posts', $user) }}"
                           class="inline-block px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Показать все лайки на статьи
                        </a>
                    </div>
                @endif
            </div>
            @if($user->liked_comments_count > 10)
                <div class="mt-4 text-center">
                    <a href="{{ route('user.liked-comments', $user) }}"
                       class="inline-block px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Показать все лайки на комментарии
                    </a>
                </div>
            @endif
    </div>
    @endif

    @if($user->likes->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">Пользователь еще не поставил ни одного лайка</p>
        </div>
    @endif
</div>
