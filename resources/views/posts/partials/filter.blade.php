<form method="GET" action="{{ route('posts.index') }}" id="filter-form">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <!-- Поиск -->
        <div class="flex-1">
            <div class="relative">
                <x-inputs.text-input type="text" name="search" class="w-full"
                                     placeholder="Поиск по статьям..."
                                     value="{{ request()->get('search') ?? '' }}"
                />
            </div>
            <x-inputs.input-error :messages="$errors->get('search')" />
        </div>

        <!-- Кнопки сброса/применения -->
        <div class="flex gap-3">
            <x-buttons.secondary-button :href="route('posts.index')" :value="'Сбросить'"/>
            <x-buttons.primary-button :value="'Применить'"/>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Первая строка фильтров -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Сортировка -->
            <div>
                <x-inputs.input-label class="pb-2 ps-2">Сортировка</x-inputs.input-label>
                <select name="sort" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="newest" {{ request()->get("sort")=="newest" ? 'selected' : '' }}>Новые сначала</option>
                    <option value="oldest" {{ request()->get("sort")=="oldest" ? 'selected' : '' }}>Старые сначала</option>
                    <option value="popular" {{ request()->get("sort")=="popular" ? 'selected' : '' }}>Популярные</option>
                </select>
                <x-inputs.input-error :messages="$errors->get('sort')" />
            </div>

            <!-- Категория -->
            <div>
                <x-inputs.input-label class="pb-2 ps-2">Категория</x-inputs.input-label>
                <select name="category_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
                <x-inputs.input-error :messages="$errors->get('category_id')" />
            </div>
        </div>

        <!-- Теги -->
        <div>

            <x-inputs.input-label class="pb-2 ps-2">Теги</x-inputs.input-label>

            <!-- Видимые теги -->
            <div class="flex flex-wrap gap-3 mb-3">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               {{ in_array($tag->id, request()->get('tags', [])) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                        <span class="ml-2 text-sm text-gray-700">#{{ $tag->title }}</span>
                    </label>
                @endforeach
                @error('tags.*')
                    <span class="text-red-600">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>
</form>
