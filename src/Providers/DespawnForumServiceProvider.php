<?php

namespace Despawn\Providers;

use Illuminate\Support\ServiceProvider;

class DespawnForumServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadPublishers();
        $this->loadMergers();
        $this->loadCommands();
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
}