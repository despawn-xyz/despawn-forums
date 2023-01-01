<?php

namespace Despawn\Providers;

use Despawn\Models\Comment;
use Despawn\Models\Thread;
use Despawn\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Despawn\Observers\CommentObserver;
use Despawn\Observers\ThreadObserver;
use Despawn\Observers\UserObserver;

class DespawnForumServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadPublishers();
        $this->loadMergers();
        $this->loadCommands();
        $this->loadRelations();
        $this->loadObservers();
        $this->loadRouteBinding();
    }

    private function loadPublishers()
    {
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/despawn-forums'),
        ], 'despawn-forums-views');

        $this->publishes([
            __DIR__ . '/../../config/despawn-forums.php' => config_path('despawn-forums.php'),
        ], 'despawn-forums-config');

        $this->publishes([
            __DIR__ . '/../../public/vendor/despawn-forums' => public_path('vendor/despawn-forums'),
        ], ['despawn-forums-assets', 'laravel-assets']);
    }

    private function loadMergers()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/despawn-forums.php',
            'despawn-forums'
        );

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'despawn-forums');
    }

    private function loadCommands()
    {
    }

    private function loadRelations()
    {
        User::resolveRelationUsing('threads', function ($user) {
            return $user->hasMany(Thread::class, 'user_id');
        });
    }

    private function loadObservers()
    {
        Thread::observe(ThreadObserver::class);
        Comment::observe(CommentObserver::class);
        User::observe(UserObserver::class);
    }

    private function loadRouteBinding()
    {
        Route::bind('thread', function ($value) {
            $thread = Thread::whereSlug($value)
                ->orWhere('id', '=', $value)
                ->first();

            throw_if(! isset($thread?->board), (new ModelNotFoundException)->setModel(Thread::class));

            throw_if(! isset($thread?->board->category), (new ModelNotFoundException)->setModel(Thread::class));


            return $thread ?? throw (new ModelNotFoundException)->setModel(Thread::class);
        });
    }
}