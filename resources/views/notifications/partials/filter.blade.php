<form action="{{ route('notifications.index') }}" method="GET">
    @csrf
    <div class="mb-6 flex items-center gap-4 border-b border-gray-200 pb-3">
        <select name="filter" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            <option value="all" {{ request()->get("filter")=="all" ? 'selected' : '' }}>Все</option>
            <option value="unread" {{ request()->get("filter")=="unread" ? 'selected' : '' }}>Непрочитанные</option>
            <option value="read" {{ request()->get("filter")=="read" ? 'selected' : '' }}>Прочитанные</option>
        </select>
        <div class="flex gap-3">
            <x-buttons.secondary-button :href="route('notifications.index')" :value="'Сбросить'"/>
            <x-buttons.primary-button :value="'Применить'"/>
        </div>
    </div>
</form>
