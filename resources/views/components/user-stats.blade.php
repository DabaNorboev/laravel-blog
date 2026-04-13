@props(['user'])

<div {{ $attributes->merge(['class' => 'flex items-center gap-6']) }}>
    <x-user-stats-item :value="$user->posts_count" label="статей" />
    <x-user-stats-item :value="$user->posts_views_sum ?? 0" label="просмотров" />
    <x-user-stats-item :value="$user->posts_likes_sum ?? 0" label="лайков" />
    <x-user-stats-item :value="$user->posts_comments_count ?? 0" label="комментариев" />
</div>
