<?php

use Illuminate\Support\Facades\Route;

Route::prefix('forums')->name('forums.')->group(function () {
    Route::resource('category', \Despawn\Http\Controllers\Forums\Forums\CateogryController::class)
        ->only(['show']);

    Route::resource('board', \Despawn\Http\Controllers\Forums\Forums\BoardController::class)
        ->only(['show']);

    Route::resource('board.thread', \Despawn\Http\Controllers\Forums\Forums\ThreadController::class)
        ->only(['show', 'create', 'store', 'update', 'destroy'])
        ->shallow();

    Route::resource('thread.comment', \Despawn\Http\Controllers\Forums\Forums\CommentController::class)
        ->only(['store', 'update', 'destroy'])
        ->shallow();
});
