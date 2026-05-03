<x-app-layout>
    <!-- Основная информация -->
    <div class="mb-12">
        <div class="flex flex-col items-center">
            <!-- Левая часть -->
            <h1 class="text-xl font-medium text-gray-900 mb-1 ps-3">{{ $user->name }}</h1>
            <p class="text-gray-500 text-sm mb-4">{{ $user->email }}</p>
            <div class="flex gap-6 mt-4">
                <div class="text-center">
                    <div class="text-2xl font-semibold text-gray-900">{{ $user->posts_count ?? 0 }}</div>
                    <div class="text-sm text-gray-500">статей</div>
                </div>

                <div class="text-center">
                    <div class="text-2xl font-semibold text-gray-900">{{ number_format($user->posts_views_sum ?? 0) }}</div>
                    <div class="text-sm text-gray-500">просмотров</div>
                </div>

                <div class="text-center">
                    <div class="text-2xl font-semibold text-gray-900">{{ $user->posts_likes_sum ?? 0 }}</div>
                    <div class="text-sm text-gray-500">лайков</div>
                </div>

                <div class="text-center">
                    <div class="text-2xl font-semibold text-gray-900">{{ $user->posts_comments_count ?? 0 }}</div>
                    <div class="text-sm text-gray-500">комментариев</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-semibold text-gray-900">{{ $user->followings_count ?? 0 }}</div>
                    <div class="text-sm text-gray-500">подписок</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-semibold text-gray-900">{{ $user->followers_count ?? 0 }}</div>
                    <div class="text-sm text-gray-500">подписчиков</div>
                </div>
            </div>
            <div>
                @if(Auth::user()->isFollowed($user))
                    <form action="{{ route('followers.unfollow', ['following' => $user]) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-normal text-base text-white">
                            Отписаться
                        </button>
                    </form>
                @else
                    <form action="{{ route('followers.follow', ['following' => $user]) }}" method="POST" class="space-y-8">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-normal text-base text-white">
                            Подписаться
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Табы для переключения -->
    <div class="border-t border-gray-300 mx-12 pt-8 mt-8">
        <div class="border-b border-gray-200 mb-6">
            <h1 class="mb-4 text-lg text-gray-500">Действия пользователя</h1>
            <nav class="-mb-px flex space-x-8">
                <button id="posts-tab"
                        class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-200 active"
                        data-target="posts-content">
                    Статьи ({{ $user->posts_count }})
                </button>
                <button id="comments-tab"
                        class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-200"
                        data-target="comments-content">
                    Комментарии ({{ $user->comments_count }})
                </button>
                <button id="likes-tab"
                        class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-200"
                        data-target="likes-content">
                    Лайки ({{ $user->liked_posts_count ?? 0}})
                </button>
            </nav>
        </div>

        <!-- Контент постов -->
        @include('users.partials.user-posts')

        <!-- Контент комментариев -->
        @include('users.partials.comments-by-user-feed')

        <!-- Контент лайков -->
        @include('users.partials.liked-posts-feed')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');

                    // Убираем активный класс у всех табов и контентов
                    tabs.forEach(t => {
                        t.classList.remove('active', 'border-blue-600', 'text-blue-600');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });

                    contents.forEach(c => {
                        c.classList.remove('active');
                        c.classList.add('hidden');
                    });

                    // Добавляем активный класс текущему табу и контенту
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('active', 'border-blue-600', 'text-blue-600');

                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                        targetContent.classList.add('active');
                    }
                });
            });

            // Инициализация активного таба
            const activeTab = document.querySelector('.tab-button.active');
            if (activeTab) {
                activeTab.classList.remove('border-transparent', 'text-gray-500');
                activeTab.classList.add('border-blue-600', 'text-blue-600');
            }
        });
    </script>

    <style>
        .tab-button.active {
            border-color: #2563eb;
            color: #2563eb;
        }

        .tab-content {
            transition: opacity 0.2s ease-in-out;
        }

        .tab-content:not(.active) {
            display: none;
        }
    </style>
</x-app-layout>
