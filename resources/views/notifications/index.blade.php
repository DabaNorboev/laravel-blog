<x-app-layout>
            <div class="py-4 px-16">
                <!-- Заголовок страницы -->
                <div class="mb-8">
                    <h1 class="text-3xl font-light text-gray-800 mb-2">Уведомления</h1>
                    <p class="text-gray-500">Все ваши уведомления в одном месте</p>
                </div>

                <!-- Фильтры уведомлений -->
                <div class="mb-6 flex items-center gap-4 border-b border-gray-200">
                    <button class="px-4 py-2 text-blue-600 border-b-2 border-blue-600 font-medium transition-colors">
                        Все
                    </button>
                    <button class="px-4 py-2 text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition-colors">
                        Непрочитанные
                    </button>
                    <button class="px-4 py-2 text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition-colors">
                        Прочитанные
                    </button>
                </div>

                @include('notifications.partials.feed')

                @include('notifications.partials.empty-feed')
            </div>
</x-app-layout>
