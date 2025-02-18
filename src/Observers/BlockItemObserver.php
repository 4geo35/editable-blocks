<?php

namespace GIS\EditableBlocks\Observers;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use GIS\EditableBlocks\Models\BlockItem;

class BlockItemObserver
{
    public function creating(BlockItemModelInterface $item): void
    {
        $itemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        $priority = $itemModelClass::query()
            ->select("id", "priority")
            ->where("block_id", $item->block_id)
            ->max("priority");
        if (empty($priority)) $priority = 0;
        $item->priority = $priority + 1;
    }

    public function deleted(BlockItemModelInterface $item): void
    {
        $record = $item->recordable;
        if (! empty($record)) $record->delete();
    }
}
