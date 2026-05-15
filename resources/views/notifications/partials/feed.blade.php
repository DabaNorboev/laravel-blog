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
                                            <span>
                                                @if($notification->created_at->diffInHours() < 24)
                                                    {{ $notification->created_at->diffForHumans() }}
                                                @else
                                                    {{ $notification->created_at->format('d.m.Y H:i') }}
                                                @endif
                                            </span>
                        @if(!$notification->read)
                            <span class="text-green-600">Новое</span>
                        @else()
                            <span>Прочитано</span>
                        @endif
                    </div>
                </div>
            </div>

            @if(!$notification->read)
                <form action="{{ route('notifications.mark-as-read', $notification) }}" method="POST">
                    @method("PATCH")
                    @csrf
                    <button class="text-gray-400 hover:text-gray-600 transition-colors text-sm" type="submit">
                        Отметить
                    </button>
                </form>
            @endif
        </div>
    @endforeach
</div>
