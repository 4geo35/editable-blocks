<?php

return [
    // Settings
    "availableTypes" => [
        "imageText" => [
            "title" => "Текст с изображением",
            // Livewire компонент для админки
            "admin" => "eb-image-text",
            // Компонент для вывода блока
            "render" => "eb::types.image-text",
        ],
        "collapseText" => [
            "title" => "Аккордеон",
            // Livewire компонент для админки
            "admin" => "eb-collapse-text",
            // Компонент для вывода блока
            "render" => "eb::types.collapse-text",
        ],
    ],
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

    "customImageTextComponent" => null,
    "customCollapseTextComponent" => null,

    // Templates
    "templates" => [
        "image-text-record" => \GIS\EditableBlocks\Templates\ImageTextRecord::class,
        "image-text-record-tablet" => \GIS\EditableBlocks\Templates\ImageTextRecordTablet::class,
        "image-text-record-mobile" => \GIS\EditableBlocks\Templates\ImageTextRecordMobile::class,

        "image-text-record-two-thirds" => \GIS\EditableBlocks\Templates\ImageTextRecordTwoThirds::class,

        "collapse-record" => \GIS\EditableBlocks\Templates\CollapseRecord::class,
        "collapse-record-tablet" => \GIS\EditableBlocks\Templates\CollapseRecordTablet::class,
        "collapse-record-mobile" => \GIS\EditableBlocks\Templates\CollapseRecordMobile::class,
    ],

    // Policy
    "blockPolicyTitle" => "Управление блоками",
    "blockPolicy" => \GIS\EditableBlocks\Policies\BlockPolicy::class,
    "blockPolicyKey" => "blocks",
];
