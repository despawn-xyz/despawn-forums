<?php

use Illuminate\Support\Facades\Route;

Route::prefix('forums')->middleware(['web', \Despawn\Http\Middleware\ForumsHandleInertiaRequests::class])->name('forums.')->group(function () {
    Route::get('/', [\Despawn\Http\Controllers\Forums\IndexController::class, '__invoke'])->name('index');

    Route::resource('category', \Despawn\Http\Controllers\Forums\CateogryController::class)
        ->only(['show']);

    Route::resource('board', \Despawn\Http\Controllers\Forums\BoardController::class)
        ->only(['show']);

    Route::resource('board.thread', \Despawn\Http\Controllers\Forums\ThreadController::class)
        ->only(['show', 'create', 'store', 'update', 'destroy'])
        ->shallow();

    Route::resource('thread.comment', \Despawn\Http\Controllers\Forums\CommentController::class)
        ->only(['store', 'update', 'destroy'])
        ->shallow();
});
