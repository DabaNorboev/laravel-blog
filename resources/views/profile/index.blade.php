<x-app-layout>
    @include('profile.partials.filter')
    <!-- Список авторов -->
    <div class="mx-12">
        @include('profile.partials.profiles-feed')
        <!-- Пагинация -->
        <div class="mt-2 pb-6 pt-14">
            {{ $users->links('pagination::tailwind') }}
        </div>

        <!-- Сообщение, если ничего не найдено -->
        @if($users->isEmpty())
            <div class="py-12 text-center">
                <div class="text-gray-600 text-lg mb-2">Авторы не найдены</div>
                <p class="text-gray-500">Попробуйте изменить параметры поиска</p>
                <x-buttons.primary-button :href="route('profile.index')" :value="'Сбросить фильтры'" class="mt-4"/>
            </div>
        @endif
    </div>
</x-app-layout>
