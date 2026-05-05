<x-app-layout>
            <div class="py-4 px-16">
                <!-- Заголовок страницы -->
                <div class="mb-8">
                    <h1 class="text-3xl font-light text-gray-800 mb-2">Уведомления</h1>
                    <p class="text-gray-500">Все ваши уведомления в одном месте</p>
                </div>
                @include('notifications.partials.filter')
                <!-- Список уведомлений -->
                <div class="space-y-1">
                    @foreach($notifications as $notification)
                        <!-- Уведомление 1: Лайк поста -->
                        <div class="flex items-center justify-between py-4 px-4 hover:bg-gray-50 rounded-lg transition-colors border-b border-gray-100">
                            <div class="flex items-center gap-4">
                                <x-user-avatar :user="$notification->user->name" />
                                <!-- Контент уведомления -->
                                <div>
                                    <div class="mb-1">
                                        <div>
                                            <a href="{{ route('users.show', ['user' => $notification->from_user_id]) }}" class="font-medium text-gray-800 hover:text-blue-600 transition-colors">{{ $notification->user->name }}</a>

                                            @if($notification->type === 'comment_posted')
                                                <span class="text-gray-600"> оставил(а) комментарий к вашему посту</span>
                                            @elseif($notification->type === 'user_followed')
                                                <span class="text-gray-600"> подписал(ся/ась) на ваш профиль</span>
                                            @elseif($notification->type === 'post_liked')
                                                <span class="text-gray-600"> поставил(а) лайк вашему посту</span>
                                            @elseif($notification->type === 'comment_liked')
                                                <span class="text-gray-600"> поставил(а) лайк вашему комментарию к посту</span>
                                            @endif

                                            @if(!empty($notification->data))
                                                <a href="{{ route('posts.show', ['post' => $notification->data['post_id']]) }}" class="text-gray-800 hover:text-blue-600 transition-colors font-medium">«{{ $notification->data['post_title'] }}»</a>
                                            @endif


                                        </div>

                                        @if(($notification->type === 'comment_posted' || $notification->type === 'comment_liked') && !empty($notification->data['comment_text']))
                                            <div class="mt-2 p-3 bg-gray-50 rounded-lg border border-gray-100 text-gray-700 text-sm">
                                                {{ $notification->data['comment_text'] }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-4 text-sm text-gray-400">
                                        <span>2 часа назад</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span class="text-green-600">Новое</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Кнопка отметить прочитанным -->
                            <button class="text-gray-400 hover:text-gray-600 transition-colors text-sm">
                                Отметить
                            </button>
                        </div>
                    @endforeach

{{--                    <!-- Уведомление 2: Комментарий к посту -->--}}
{{--                    <div class="flex items-center justify-between py-4 px-4 hover:bg-gray-50 rounded-lg transition-colors border-b border-gray-100">--}}
{{--                        <div class="flex items-center gap-4">--}}
{{--                            <!-- Аватар -->--}}
{{--                            <div class="flex-shrink-0">--}}
{{--                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">--}}
{{--                                    <span class="text-green-600 font-medium text-lg">МС</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Контент уведомления -->--}}
{{--                            <div>--}}
{{--                                <div class="mb-1">--}}
{{--                                    <span class="font-medium text-gray-800">Максим Сергеев</span>--}}
{{--                                    <span class="text-gray-600"> прокомментировал ваш пост </span>--}}
{{--                                    <a href="#" class="text-gray-800 hover:text-blue-600 transition-colors font-medium">"Оптимизация запросов к базе данных"</a>--}}
{{--                                </div>--}}
{{--                                <div class="text-gray-600 text-sm mb-2 line-clamp-1">--}}
{{--                                    "Отличная статья! Очень помогло разобраться в этой теме..."--}}
{{--                                </div>--}}
{{--                                <div class="flex items-center gap-4 text-sm text-gray-400">--}}
{{--                                    <span>5 часов назад</span>--}}
{{--                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>--}}
{{--                                    <span class="text-green-600">Новое</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <button class="text-gray-400 hover:text-gray-600 transition-colors text-sm">--}}
{{--                            Отметить--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                    <!-- Уведомление 3: Подписка на профиль -->--}}
{{--                    <div class="flex items-center justify-between py-4 px-4 hover:bg-gray-50 rounded-lg transition-colors border-b border-gray-100">--}}
{{--                        <div class="flex items-center gap-4">--}}
{{--                            <!-- Аватар -->--}}
{{--                            <div class="flex-shrink-0">--}}
{{--                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">--}}
{{--                                    <span class="text-purple-600 font-medium text-lg">ЕП</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Контент уведомления -->--}}
{{--                            <div>--}}
{{--                                <div class="mb-1">--}}
{{--                                    <span class="font-medium text-gray-800">Елена Петрова</span>--}}
{{--                                    <span class="text-gray-600"> подписалась на ваш профиль</span>--}}
{{--                                </div>--}}
{{--                                <div class="flex items-center gap-4 text-sm text-gray-400">--}}
{{--                                    <span>вчера</span>--}}
{{--                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>--}}
{{--                                    <span>Прочитано</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                {{--                @if(empty($notifications))--}}
{{--                    @include('notifications.partials.empty-feed')--}}
{{--                @else--}}
{{--                    @include('notifications.partials.feed')--}}
{{--                @endif--}}
            </div>
</x-app-layout>
