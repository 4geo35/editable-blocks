<?php

return [
    // Settings
    "availableTypes" => [
        "imageText" => "Текст с изображением",
        "collapseText" => "Аккордеон",
    ],
    "customAvailableTypes" => [], // TODO: add to render
    "typeComponents" => [
        "imageText" => "eb-image-text",
        "collapseText" => "eb-collapse-text",
    ],
    "customTypeComponents" => [], // TODO: add to render
    "groups" => [],
    "static" => [],
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
