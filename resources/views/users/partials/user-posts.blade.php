<div id="posts-content" class="tab-content active">
    <div class="space-y-4">
        @forelse($user->posts as $post)
            <div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-gray-900 font-medium mb-1">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <div class="flex items-center gap-3 text-gray-500 text-sm mb-2">
                            <span>{{ $post->created_at->format('d.m.Y') }}</span>
                            <span>👁 {{ $post->views }}</span>
                            <span>👍 {{ $post->likes()->count() }}</span>
                            <span>💬 {{ $post->comments()->count()}}</span>
                        </div>
                        @if($post->excerpt)
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $post->excerpt }}</p>
                        @endif
                    </div>

                    <a href="{{ route('posts.show', $post) }}"
                       class="ml-4 text-blue-600 hover:text-blue-800 text-sm font-medium whitespace-nowrap">
                        Читать
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-gray-500">У пользователя пока нет статей</p>
            </div>
        @endforelse
    </div>
</div>
