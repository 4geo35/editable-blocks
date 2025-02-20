<?php

namespace GIS\EditableBlocks;

use GIS\EditableBlocks\Commands\CreateBlocksCommand;
use GIS\EditableBlocks\Helpers\BlockRenderActionsManager;
use GIS\EditableBlocks\Livewire\Admin\Types\CollapseTextWire;
use GIS\EditableBlocks\Livewire\Admin\Types\ImageTextWire;
use GIS\EditableBlocks\Helpers\BlockActionsManager;
use GIS\EditableBlocks\Livewire\Admin\Blocks\BlockListWire;
use GIS\EditableBlocks\Livewire\Admin\Blocks\ManageBlocksWire;
use GIS\EditableBlocks\Livewire\Admin\Blocks\SwitchGroupWire;
use GIS\EditableBlocks\Models\Block;
use GIS\EditableBlocks\Models\BlockItem;
use GIS\EditableBlocks\Observers\BlockItemObserver;
use GIS\EditableBlocks\Observers\BlockObserver;
use GIS\Fileable\Traits\ExpandTemplatesTrait;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class EditableBlocksServiceProvider extends ServiceProvider
{
    use ExpandTemplatesTrait;
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

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateBlocksCommand::class,
            ]);
        }
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

        $component = config("editable-blocks.customCollapseTextComponent");
        Livewire::component(
            "eb-collapse-text",
            $component ?? CollapseTextWire::class
        );
    }

    protected function initFacades(): void
    {
        $this->app->singleton("block-actions", function () {
            $blockActionsManagerClass = config("editable-blocks.customBlockActionsManager") ?? BlockActionsManager::class;
            return new $blockActionsManagerClass;
        });
        $this->app->singleton("block-render-actions", function () {
            $blockRenderActionsManagerClass = config("editable-blocks.customBlockRenderActionsManager") ?? BlockRenderActionsManager::class;
            return new $blockRenderActionsManagerClass;
        });
    }

    protected function expandConfiguration(): void
    {
        $eb = app()->config["editable-blocks"];
        $this->expandTemplates($eb);

        $um = app()->config["user-management"];
        $permissions = $um["permissions"];
        $permissions[] = [
            "title" => $eb["blockPolicyTitle"],
            "key" => $eb["blockPolicyKey"],
            "policy" => $eb["blockPolicy"],
        ];
        app()->config["user-management.permissions"] = $permissions;
    }
}
