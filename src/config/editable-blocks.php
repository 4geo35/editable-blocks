<?php

return [
    // Settings
    "availableTypes" => [
        "imageText" => "Текст с изображением",
        "collapseText" => "Аккордеон",
    ],
    "customAvailableTypes" => [],
    // Livewire компонент для админки
    "typeComponents" => [
        "imageText" => "eb-image-text",
        "collapseText" => "eb-collapse-text",
    ],
    "customTypeComponents" => [],
    // Компонент для вывода блока
    "typeRenderComponents" => [
        "imageText" => "eb::types.image-text",
        "collapseText" => "eb::types.collapse-text",
    ],
    "customTypeRenderComponents" => [],

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

        "collapse-record" => \GIS\EditableBlocks\Templates\CollapseRecord::class,
        "collapse-record-tablet" => \GIS\EditableBlocks\Templates\CollapseRecordTablet::class,
        "collapse-record-mobile" => \GIS\EditableBlocks\Templates\CollapseRecordMobile::class,
    ],

    // Policy
    "blockPolicyTitle" => "Управление блоками",
    "blockPolicy" => \GIS\EditableBlocks\Policies\BlockPolicy::class,
    "blockPolicyKey" => "blocks",
];
