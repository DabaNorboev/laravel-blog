<x-app-layout>

            <div class="py-4 px-16">
                <!-- Заголовок страницы -->
                <div class="mb-8">
                    <h1 class="text-3xl font-light text-gray-800 mb-4">Редактирование поста</h1>
                    <p class="text-gray-600">Внесите изменения в пост ниже</p>
                </div>

                <!-- Форма редактирования -->
                <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- Основная информация -->
                    <div class="space-y-6">
                        <!-- Заголовок -->
                        <div>
                            <x-inputs.input-label for="title" value="Заголовок поста" class="pb-2"/>
                            <x-inputs.text-input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                                                 class="w-full" placeholder="Введите заголовок поста" required
                            />
                            <x-inputs.input-error :messages="$errors->get('title')" />
                        </div>

                        <!-- Категория -->
                        <div>
                            <x-inputs.input-label for="category_id" value="Категория" class="pb-2"/>
                            <select id="category_id"
                                    name="category_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-inputs.input-error :messages="$errors->get('category_id')" />
                        </div>

                        <!-- Теги -->
                        <div>
                            <x-inputs.input-label value="Теги" class="pb-2"/>
                            <div class="flex flex-wrap gap-4">
                                @foreach($tags as $tag)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox"
                                               name="tags[]"
                                               value="{{ $tag->id }}"
                                               {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">#{{ $tag->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-inputs.input-error :messages="$errors->get('tags')" />
                        </div>

                        <!-- Изображение (текстовое поле для URL) -->
                        <div>
                            <x-inputs.input-label for="image" value="Изображение" class="pb-2"/>

                            <!-- Текущее изображение -->
                            @if($post->image)
                                <div class="mb-4">
                                    <div class="relative w-64 h-48 rounded-lg overflow-hidden border border-gray-300 mb-2">
                                        <img src="{{ $post->image }}"
                                             alt="Текущее изображение"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-gray-500">Текущее изображение</p>
                                </div>
                            @endif

                            <!-- Поле для ввода URL изображения -->
                            <x-inputs.text-input type="text"
                                               id="image"
                                               name="image"
                                               value="{{ old('image', $post->image) }}"
                                               class="w-full"
                                               placeholder="Введите URL изображения"
                            />
                            <p class="mt-2 text-sm text-gray-500">Введите полный URL изображения (например, https://example.com/image.jpg)</p>
                            <x-inputs.input-error :messages="$errors->get('image')" />
                        </div>

                        <!-- Контент -->
                        <div>
                            <x-inputs.input-label for="content"/>

                            <x-inputs.textarea id="content" name="content" rows="10" class="w-full" required
                                               placeholder="Напишите содержание поста..." :value="old('content', $post->content)"/>
                            <x-inputs.input-error :messages="$errors->get('content')" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                        <x-buttons.secondary-button :href="route('posts.show', $post)">
                            Отмена
                        </x-buttons.secondary-button>

                        <x-buttons.primary-button type="submit">
                            Обновить пост
                        </x-buttons.primary-button>
                    </div>
                </form>
            </div>
</x-app-layout>
