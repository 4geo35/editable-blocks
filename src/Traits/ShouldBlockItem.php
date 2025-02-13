<?php

namespace GIS\EditableBlocks\Traits;

use GIS\EditableBlocks\Models\BlockItem;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ShouldBlockItem
{
    public function item(): MorphOne
    {
        $blockItemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        return $this->morphOne($blockItemModelClass, "recordable");
    }
}
