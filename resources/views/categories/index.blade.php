<x-app-layout>
    <div class="border-gray-300 mx-12 py-2 mb-8 overflow-hidden flex justify-between items-center">
        <x-buttons.primary-button :value="'Новая категория'" :href="route('categories.create')" />

        <div class="text-gray-500 text-sm">
            Всего категорий: {{ $categories->count() }}
        </div>
    </div>

    @foreach($categories as $category)
        <div class="border-t border-gray-300 mx-12 py-6 h-64 overflow-hidden">
            <div class="category flex gap-4 w-[90%] mx-auto h-full">

                <!-- Название категории слева -->
                <div class="category-name w-[55%] flex flex-col justify-center">
                    <a href="{{ route('posts.index', ['category_id' => $category->id]) }}">
                        <h2 class="text-xl uppercase line-clamp-2 mb-3 font-light">
                            {{$category->title}}
                        </h2>
                    </a>

                    <!-- Кнопки действий для категории -->
                    <div class="flex items-center gap-3 mt-4">
                        <!-- Кнопка редактирования -->
                        <x-buttons.primary-button :value="'Редактировать'" :href="route('categories.edit', $category->id)"/>

                        <!-- Кнопка удаления -->
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Вы уверены, что хотите удалить категорию {{ $category->title }}?')"
                            class="inline-flex items-center px-4 py-2 bg-white border font-normal border-gray-300 rounded-md text-base text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Удалить
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Популярные статьи справа -->
                <div class="popular-articles w-[45%] flex flex-col h-full">
                    <div class="flex-none mb-4">
                        <p class="text-gray-500 text-sm uppercase tracking-wider">
                            Популярные статьи
                        </p>
                    </div>

                    <!-- Контейнер со списком -->
                    <div class="flex-grow overflow-y-auto pr-2 space-y-3">
                        @foreach($category->posts as $post)
                            <div class="border-t border-gray-200 pt-3 first:border-t-0 first:pt-0">
                                <a href="{{ route('posts.show', $post) }}">
                                    <h3 class="text-gray-800 line-clamp-2 text-sm mb-1 leading-snug">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-gray-500 text-xs">
                                        @if($post->created_at->diffInHours() < 24)
                                            {{ $post->created_at->diffForHumans() }}
                                        @else
                                            {{ $post->created_at->translatedFormat('d M H:i') }}
                                        @endif
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</x-app-layout>
