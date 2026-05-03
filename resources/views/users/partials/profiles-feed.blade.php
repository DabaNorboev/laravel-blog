@foreach($users as $user)
    <div class="border-b border-gray-100 py-6 hover:bg-gray-50 transition-colors duration-150">
        <div class="flex items-center justify-between">
            <!-- Информация об авторе -->
            <div class="flex items-center gap-4">
                <!-- Аватар -->
                <x-user-avatar :user="$user->name"/>
                <!-- Имя -->
                <div>
                    <a href="{{ route('users.show', $user) }}">
                        <h2 class="text-lg font-medium text-gray-900">{{ $user->name }}</h2>
                    </a>
                </div>
            </div>

            <!-- Статистика -->
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
        </div>
    </div>
@endforeach
