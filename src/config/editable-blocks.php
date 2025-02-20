<?php

return [
    // Settings
    "availableTypes" => [
        "imageText" => "Текст с изображением",
        "collapseText" => "Аккордеон",
    ],
    "customAvailableTypes" => [],
    "typeComponents" => [
        "imageText" => "eb-image-text",
        "collapseText" => "eb-collapse-text",
    ],
    "customTypeComponents" => [],
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

    "customImageTextComponent" => null,
    "customCollapseTextComponent" => null,

    // Templates
    "templates" => [
        "image-text-record" => \GIS\EditableBlocks\Templates\ImageTextRecord::class,
        "collapse-record" => \GIS\EditableBlocks\Templates\CollapseRecord::class,
    ],

    // Policy
    "blockPolicyTitle" => "Управление блоками",
    "blockPolicy" => \GIS\EditableBlocks\Policies\BlockPolicy::class,
    "blockPolicyKey" => "blocks",
];
