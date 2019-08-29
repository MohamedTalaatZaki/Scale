<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $base_migration_dir = __DIR__.'/../../database/migrations';
        $paths = [
            "{$base_migration_dir}/MasterData",
        ];
        $this->loadMigrationsFrom($paths);
    }
}
