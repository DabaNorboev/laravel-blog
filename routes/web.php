<?php

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Controllers\Post\DestroyController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main.index');
})->middleware(['auth', 'verified'])->name('main');

Route::middleware('auth')->group(function () {

    Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('{type}/{id}/like', [LikeController::class, 'toggle'])->name('like.toggle');

    Route::prefix('/posts')->name('posts.')->group(function () {
        Route::get('/', IndexController::class)->name('index');
        Route::get('/{post}', ShowController::class)->name('show');
        Route::get('/create', CreateController::class)->name('create');
        Route::post('/', StoreController::class)->name('store');
        Route::get('/{post}/edit', EditController::class)->name('edit');
        Route::patch('/{post}', UpdateController::class)->name('update');
        Route::delete('/{post}', DestroyController::class)->name('destroy');
    });

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::prefix('/category')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});


require __DIR__.'/auth.php';
