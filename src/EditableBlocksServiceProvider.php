<?php

namespace GIS\EditableBlocks;

use Illuminate\Support\ServiceProvider;

class EditableBlocksServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "eb");

        // Livewire
        $this->addLivewireComponents();
    }

    public function register(): void
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Config
        $this->mergeConfigFrom(__DIR__ . "/config/editable-blocks.php", "editable-blocks");

        // Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");
    }

    protected function addLivewireComponents(): void
    {

    }
}
