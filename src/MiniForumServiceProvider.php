<?php

namespace Jdsf\MiniForum;

use Illuminate\Support\ServiceProvider;

class MiniForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                __DIR__.'/database/migrations/' => database_path('migrations/miniforum')
            ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->commands([\Jdsf\MiniForum\Console\Commands\Install::class]);
    }
}
