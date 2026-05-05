<?php

namespace App\Providers;

use App\Events\Comment\CommentPostedEvent;
use App\Events\Like\CommentLikedEvent;
use App\Events\Like\PostLikedEvent;
use App\Events\LikedEvent;
use App\Events\User\UserFollowedEvent;
use App\Listeners\Notify\NotifyCommentAuthorAboutLikeListener;
use App\Listeners\Notify\NotifyNewFollowerListener;
use App\Listeners\Notify\NotifyPostAuthorAboutCommentListener;
use App\Listeners\Notify\NotifyPostAuthorAboutLikeListener;
use App\Models\Follower;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            CommentPostedEvent::class,
            NotifyPostAuthorAboutCommentListener::class
        );
        Event::listen(
            PostLikedEvent::class,
            NotifyPostAuthorAboutLikeListener::class
        );
        Event::listen(
            CommentLikedEvent::class,
            NotifyCommentAuthorAboutLikeListener::class
        );
        Event::listen(
            UserFollowedEvent::class,
            NotifyNewFollowerListener::class
        );

        Relation::enforceMorphMap([
            'post' => 'App\Models\Post',
            'comment' => 'App\Models\Comment',
            'like' => 'App\Models\Like',
            'follower' => 'App\Models\Follower',
        ]);

        Paginator::defaultView('vendor.pagination.tailwind');
    }
}
