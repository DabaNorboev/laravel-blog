<!-- Список уведомлений -->
<div class="space-y-1">

    <!-- Уведомление 1: Лайк поста -->
    <div class="flex items-center justify-between py-4 px-4 hover:bg-gray-50 rounded-lg transition-colors border-b border-gray-100">
        <div class="flex items-center gap-4">
            <!-- Аватар -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-600 font-medium text-lg">АИ</span>
                </div>
            </div>

            <!-- Контент уведомления -->
            <div>
                <div class="mb-1">
                    <span class="font-medium text-gray-800">Анна Иванова</span>
                    <span class="text-gray-600"> поставила лайк вашему посту </span>
                    <a href="#" class="text-gray-800 hover:text-blue-600 transition-colors font-medium">"Как начать работать с Laravel"</a>
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

    <!-- Уведомление 2: Комментарий к посту -->
    <div class="flex items-center justify-between py-4 px-4 hover:bg-gray-50 rounded-lg transition-colors border-b border-gray-100">
        <div class="flex items-center gap-4">
            <!-- Аватар -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="text-green-600 font-medium text-lg">МС</span>
                </div>
            </div>

            <!-- Контент уведомления -->
            <div>
                <div class="mb-1">
                    <span class="font-medium text-gray-800">Максим Сергеев</span>
                    <span class="text-gray-600"> прокомментировал ваш пост </span>
                    <a href="#" class="text-gray-800 hover:text-blue-600 transition-colors font-medium">"Оптимизация запросов к базе данных"</a>
                </div>
                <div class="text-gray-600 text-sm mb-2 line-clamp-1">
                    "Отличная статья! Очень помогло разобраться в этой теме..."
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span>5 часов назад</span>
                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                    <span class="text-green-600">Новое</span>
                </div>
            </div>
        </div>

        <button class="text-gray-400 hover:text-gray-600 transition-colors text-sm">
            Отметить
        </button>
    </div>

    <!-- Уведомление 3: Подписка на профиль -->
    <div class="flex items-center justify-between py-4 px-4 hover:bg-gray-50 rounded-lg transition-colors border-b border-gray-100">
        <div class="flex items-center gap-4">
            <!-- Аватар -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <span class="text-purple-600 font-medium text-lg">ЕП</span>
                </div>
            </div>

            <!-- Контент уведомления -->
            <div>
                <div class="mb-1">
                    <span class="font-medium text-gray-800">Елена Петрова</span>
                    <span class="text-gray-600"> подписалась на ваш профиль</span>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span>вчера</span>
                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                    <span>Прочитано</span>
                </div>
            </div>
        </div>

        <button class="text-gray-400 hover:text-gray-600 transition-colors text-sm opacity-0 group-hover:opacity-100">
            Удалить
        </button>
    </div>
</div>
