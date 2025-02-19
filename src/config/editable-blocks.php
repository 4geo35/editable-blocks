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
    // Admin
    "customAdminBlockController" => null,
    "customBlockActionsManager" => null,

    "customBlockModel" => null,
    "customBlockModelObserver" => null,

    "customBlockItemModel" => null,
    "customBlockItemModelObserver" => null,

    "customSimpleBlockRecordModel" => null,

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
];
