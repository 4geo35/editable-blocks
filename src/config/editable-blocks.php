<?php

return [
    // Settings
    "availableTypes" => [
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

    "customCollapseTextComponent" => null,

    // Templates
    "templates" => [
        "collapse-record" => \GIS\EditableBlocks\Templates\CollapseRecord::class,
        "collapse-record-tablet" => \GIS\EditableBlocks\Templates\CollapseRecordTablet::class,
        "collapse-record-mobile" => \GIS\EditableBlocks\Templates\CollapseRecordMobile::class,

        "collapse-record-two-thirds" => \GIS\EditableBlocks\Templates\CollapseRecordTwoThirds::class,
    ],

    // Policy
    "blockPolicyTitle" => "Управление блоками",
    "blockPolicy" => \GIS\EditableBlocks\Policies\BlockPolicy::class,
    "blockPolicyKey" => "blocks",
];
