@foreach($users as $user)
    <div class="border-b border-gray-100 py-6 hover:bg-gray-50 transition-colors duration-150">
        <div class="flex items-center justify-between">
            <!-- Информация об авторе -->
            <div class="flex items-center gap-4">
                <!-- Аватар -->
                <x-user-avatar :user="$user->name"/>
                <!-- Имя -->
                <div>
                    <a href="{{ route('profile.show', $user) }}">
                        <h2 class="text-lg font-medium text-gray-900">{{ $user->name }}</h2>
                    </a>
                </div>
            </div>

            <!-- Статистика -->
            <x-user-stats :user="$user"/>
        </div>
    </div>
@endforeach
