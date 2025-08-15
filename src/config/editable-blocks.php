<?php

return [
    // Settings
    "availableTypes" => [],
    "customAvailableTypes" => [],

    "groups" => [],
    "static" => [],
    "models" => [],
    "expandRender" => [],
    // Admin
    "customAdminBlockController" => null,
    "customBlockActionsManager" => null,
    "customBlockRenderActionsManager" => null,

    "customBlockModel" => null,
    "customBlockModelObserver" => null,

    "customBlockItemModel" => null,
    "customBlockItemModelObserver" => null,

    "customSimpleBlockRecordModel" => null,
    "customSimpleBlockRecordModelObserver" => null,

    "customSwitchGroupComponent" => null,
    "customManageBlocksComponent" => null,
    "customBlockListComponent" => null,

    // Templates
    "templates" => [],

    // Policy
    "blockPolicyTitle" => "Управление блоками",
    "blockPolicy" => \GIS\EditableBlocks\Policies\BlockPolicy::class,
    "blockPolicyKey" => "blocks",
];
