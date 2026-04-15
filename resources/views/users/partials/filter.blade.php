<form method="GET" action="{{ route('users.index') }}" id="filter-form" class="pb-8 border-b">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <!-- Поиск -->
        <div class="flex-1">
            <div class="relative">
                <x-inputs.text-input type="text" name="search" class="w-full"
                                     placeholder="Поиск по авторам..."
                                     value="{{ request()->get('search') ?? '' }}"
                />
            </div>
            <x-inputs.input-error :messages="$errors->get('search')" />
        </div>

        <!-- Кнопки сброса/применения -->
        <div class="flex gap-3">
            <x-buttons.secondary-button :value="'Сбросить'" :href="route('users.index')"/>
            <x-buttons.primary-button :value="'Применить'" />
        </div>
    </div>

    <div class="space-y-6">
        <!-- Чекбокс Автор -->
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox"
                       name="is_author"
                       value="1"
                       {{ request()->get('is_author') == '1' ? 'checked' : '' }}
                       class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-gray-700">Только авторы (с опубликованными статьями)</span>
            </label>
        </div>

        <!-- Сортировка -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Колонка для сортировки -->
            <div>
                <x-inputs.input-label class="pb-2">Сортировать по</x-inputs.input-label>
                <select name="sort_column"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Выберите поле</option>
                    <option value="posts" {{ request()->get('sort_column') == 'posts' ? 'selected' : '' }}>Количество статей</option>
                    <option value="views" {{ request()->get('sort_column') == 'views' ? 'selected' : '' }}>Количество просмотров</option>
                    <option value="likes" {{ request()->get('sort_column') == 'likes' ? 'selected' : '' }}>Количество лайков</option>
                    <option value="comments" {{ request()->get('sort_column') == 'comments' ? 'selected' : '' }}>Количество комментариев</option>
                </select>
                <x-inputs.input-error :messages="$errors->get('sort_column')" />
            </div>

            <!-- Направление сортировки -->
            <div>
                <x-inputs.input-label class="pb-2">Направление</x-inputs.input-label>
                <select name="sort_direction"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Выберите направление</option>
                    <option value="desc" {{ request()->get('sort_direction') == 'desc' ? 'selected' : '' }}>По убыванию (↓)</option>
                    <option value="asc" {{ request()->get('sort_direction') == 'asc' ? 'selected' : '' }}>По возрастанию (↑)</option>
                </select>
                <x-inputs.input-error :messages="$errors->get('sort_direction')" />
            </div>
        </div>
    </div>
</form>
