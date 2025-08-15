<?php

namespace GIS\EditableBlocks\Traits;

trait ExpandBlocksTrait
{
    protected function expandBlocks(array $config): void
    {
        if (empty($config["availableTypes"])) { return; }

        $eb = app()->config["editable-blocks"];
        $availableTypes = $eb["availableTypes"];
        foreach ($config["availableTypes"] as $key => $value) {
            $availableTypes[$key] = $value;
        }
        app()->config["editable-blocks.availableTypes"] = $availableTypes;
    }

    protected function expandBlockRender(array $config): void
    {
        if (empty($config["expandRender"])) { return; }

        $eb = app()->config["editable-blocks"];
        $expandRender = $eb["expandRender"];
        foreach ($config["expandRender"] as $key => $value) {
            $expandRender[$key] = $value;
        }
        app()->config["editable-blocks.expandRender"] = $expandRender;
    }
}
