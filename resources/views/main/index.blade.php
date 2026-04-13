<x-app-layout>
    <div class="border-b text-center pb-6">
        <h1 class="text-lg md:text-xl mb-4">Уважаемый читатель, добро пожаловать в наш блог</h1>
        <p class="mb-8">Исследуйте последние статьи, руководства и новости</p>
        <x-buttons.primary-button class="mt-1" :href="route('posts.index')">
            {{ 'Читать статьи' }}
        </x-buttons.primary-button>
    </div>
</x-app-layout>
