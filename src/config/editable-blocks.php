<?php

return [
    // Settings
    "availableTypes" => [
        "imageText" => "Текст с изображением"
    ],
    "typeComponents" => [
        "imageText" => "eb-image-text"
    ],
    "customTypeComponents" => [],
    "groups" => [],
    "static" => [],
    // Admin
    "customAdminBlockController" => null,
    "customBlockActionsManager" => null,
    "customBlockModel" => null,
    "customBlockModelObserver" => null,
    "customBlockItemModel" => null,
    "customSimpleBlockRecordModel" => null,

    "customSwitchGroupComponent" => null,
    "customManageBlocksComponent" => null,
    "customBlockListComponent" => null,
    "customImageTextComponent" => null,

    // Templates
    "templates" => [
        "image-text-record" => \GIS\EditableBlocks\Templates\ImageTextRecord::class,
    ],
];
