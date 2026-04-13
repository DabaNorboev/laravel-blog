<x-app-layout>
    <div class="py-4 px-16">
        <!-- Заголовок страницы -->
        <div class="mb-8">
            <h1 class="text-3xl font-light text-gray-800 mb-4">Создание категории</h1>
            <p class="text-gray-600">Добавьте новую категорию для постов</p>
        </div>

        <!-- Форма создания категории -->
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-8">
            @csrf
            <!-- Название категории -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Название категории
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Введите название категории">
                <p class="mt-2 text-sm text-gray-500">Например: Laravel, PHP, JavaScript</p>
            </div>

            <!-- Панель действий -->
            <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                <!-- Кнопка отмены -->
                <x-buttons.secondary-button :value="'Отмена'" :href="route('categories.index')" />

                <!-- Кнопка сохранения -->
                <x-buttons.primary-button  :value="'Создать'"/>
            </div>
        </form>
    </div>
</x-app-layout>
