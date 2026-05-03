<?php

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Controllers\Post\DestroyController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main.index');
})->middleware(['auth', 'verified'])->name('main');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store']);

    Route::resource('categories', CategoryController::class);

    Route::prefix('/followers')->name('followers.')->group(function () {
        Route::get('/', [FollowerController::class, 'index'])->name('index');
        Route::post('/follow/{following}', [FollowerController::class, 'follow'])->name('follow');
        Route::delete('/unfollow/{following}', [FollowerController::class, 'unfollow'])->name('unfollow');
    });




    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::post('{type}/{id}/like', [LikeController::class, 'toggle'])->name('like.toggle');

    Route::prefix('/posts')->name('posts.')->group(function () {
        Route::get('/', IndexController::class)->name('index');
        Route::get('/{post}', ShowController::class)->name('show');
        Route::get('/create', CreateController::class)->name('create');
        Route::post('/', StoreController::class)->name('store');
        Route::get('/{post}/edit', EditController::class)->name('edit');
        Route::patch('/{post}', UpdateController::class)->name('update');
        Route::delete('/{post}', DestroyController::class)->name('destroy');

        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});


require __DIR__.'/auth.php';
