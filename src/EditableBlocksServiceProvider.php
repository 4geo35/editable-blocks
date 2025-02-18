<?php

namespace GIS\EditableBlocks;

use GIS\EditableBlocks\Livewire\Admin\Types\ImageTextWire;
use GIS\EditableBlocks\Helpers\BlockActionsManager;
use GIS\EditableBlocks\Livewire\Admin\Blocks\BlockListWire;
use GIS\EditableBlocks\Livewire\Admin\Blocks\ManageBlocksWire;
use GIS\EditableBlocks\Livewire\Admin\Blocks\SwitchGroupWire;
use GIS\EditableBlocks\Models\Block;
use GIS\EditableBlocks\Models\BlockItem;
use GIS\EditableBlocks\Observers\BlockItemObserver;
use GIS\EditableBlocks\Observers\BlockObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class EditableBlocksServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "eb");

        // Livewire
        $this->addLivewireComponents();

        // Observers
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $blockObserverClass = config("editable-blocks.customBlockModelObserver") ?? BlockObserver::class;
        $blockModelClass::observe($blockObserverClass);

        $itemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        $itemObserverClass = config("editable-blocks.customBlockItemModelObserver") ?? BlockItemObserver::class;
        $itemModelClass::observe($itemObserverClass);

        // Expand configuration
        $this->expandConfiguration();
    }

    public function register(): void
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Config
        $this->mergeConfigFrom(__DIR__ . "/config/editable-blocks.php", "editable-blocks");

        // Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // Facades
        $this->initFacades();
    }

    protected function addLivewireComponents(): void
    {
        // Block
        $component = config("editable-blocks.customSwitchGroupComponent");
        Livewire::component(
            "eb-switch-group",
            $component ?? SwitchGroupWire::class
        );

        $component = config("editable-blocks.customManageBlocksComponent");
        Livewire::component(
            "eb-manage-blocks",
            $component ?? ManageBlocksWire::class
        );

        $component = config("editable-blocks.customBlockListComponent");
        Livewire::component(
            "eb-block-list",
            $component ?? BlockListWire::class
        );

        // Types
        $component = config("editable-blocks.customImageTextComponent");
        Livewire::component(
            "eb-image-text",
            $component ?? ImageTextWire::class
        );
    }

    protected function initFacades(): void
    {
        $this->app->singleton("block-actions", function () {
            $blockActionsManagerClass = config("editable-blocks.customBlockActionsManager") ?? BlockActionsManager::class;
            return new $blockActionsManagerClass;
        });
    }

    protected function expandConfiguration(): void
    {
        $eb = app()->config["editable-blocks"];

        $fa = app()->config["fileable"];
        $templates = $fa["templates"];
        foreach ($eb["templates"] as $key => $template) {
            $templates[$key] = $template;
        }
        app()->config["fileable.templates"] = $templates;
    }
}
