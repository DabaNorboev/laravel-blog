<x-app-layout>
    <div class="py-4 px-16">
        <!-- Заголовок страницы -->
        <div class="mb-8">
            <h1 class="text-3xl font-light text-gray-800 mb-4">Редактирование категории</h1>
            <p class="text-gray-600">Вы можете отредактировать информацию о категории</p>
        </div>

        <!-- Форма создания категории -->
        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-8">
            @csrf
            @method('PATCH')
            <!-- Название категории -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Название категории
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Введите новое название категории"
                       value="{{ old('title', $category->title) }}">
                <x-inputs.input-error :messages=" $errors->get('title') " />
            </div>

            <!-- Панель действий -->
            <div class="flex items-center justify-between border-gray-200">
                <!-- Кнопка отмены -->
                <x-buttons.secondary-button :value="'Отмена'" :href="route('categories.index')" />

                <!-- Кнопка сохранения -->
                <x-buttons.primary-button  :value="'Сохранить'"/>
            </div>
        </form>
    </div>
</x-app-layout>
