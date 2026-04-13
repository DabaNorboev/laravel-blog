<x-app-layout>
    @include('posts.partials.filter')
    @include('posts.partials.posts-feed')
    <div class="mt-2 pb-6 pt-14">
        {{ $posts->links('pagination::tailwind') }}
    </div>
</x-app-layout>
