<x-app-layout>
    <div class="py-4 px-16">
        <!-- Панель действий с постами -->
        <div class="mb-6 pb-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <!-- Кнопка назад -->
                <x-buttons.primary-button :href="route('posts.index')" :value="'К списку постов'"/>

                <div class="flex items-center gap-3">
                    <x-buttons.primary-button :href="route('posts.edit', $post)" :value="'Редактировать'"/>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-buttons.danger-button onclick="return confirm('Вы уверены, что хотите удалить этот пост?')" :value="'Удалить'"/>
                    </form>
                </div>
            </div>
        </div>

        @include('posts.partials.post-content')

        <!-- Панель действий (лайки, просмотры и т.д.) -->
        <div class="border-t border-gray-200 pt-6 mt-8">
            <div class="flex items-center justify-between">
                <!-- Левый блок: лайки и статистика -->
                <div class="flex items-center gap-6">
                    <form action="{{ route('like.toggle', ['type' => 'post', 'id' => $post->id]) }}" method="post">
                        @csrf
                        <!-- Кнопка лайка -->
                        <button class="flex items-center gap-2 text-gray-500 hover:text-red-700 transition-colors group" type="submit">
                            <span class="font-medium">Нравится</span>
                            <span class="text-gray-500">{{ $post->likes }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Секция комментариев -->
        @include('posts.partials.comments-feed')
    </div>
</x-app-layout>
