<x-app-layout>
            <div class="py-4 px-16">
                <!-- Заголовок страницы -->
                <div class="mb-8">
                    <h1 class="text-3xl font-light text-gray-800 mb-2">Уведомления</h1>
                    <p class="text-gray-500">Все ваши уведомления в одном месте</p>
                </div>
                @include('notifications.partials.filter')

                @if($notifications->isEmpty())
                    @include('notifications.partials.empty-feed')
                @else
                    @include('notifications.partials.feed')
                @endif

            </div>
</x-app-layout>
