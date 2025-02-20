<?php

namespace GIS\EditableBlocks\Observers;

use GIS\EditableBlocks\Facades\BlockActions;
use GIS\EditableBlocks\Facades\BlockRenderActions;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Models\Block;

class BlockObserver
{
    public function creating(BlockModelInterface $block): void
    {
        if (empty($block->title)) $block->title = BlockActions::getTypeTitle($block->type);
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $priority = $blockModelClass::query()
            ->select("id", "priority")
            ->where("group", $block->group)
            ->where("key", $block->key)
            ->where("editable_id", $block->editable_id)
            ->where("editable_type", $block->editable_type)
            ->max("priority");
        if (empty($priority)) $priority = 0;
        $block->priority = $priority + 1;
    }

    public function updating(BlockModelInterface $block): void
    {
        $this->forgetCache($block);
    }

    public function deleted(BlockModelInterface $block): void
    {
        foreach ($block->items as $item) {
            $item->delete();
        }
        $this->forgetCache($block);
    }

    protected function forgetCache(BlockModelInterface $block): void
    {
        if (! empty($block->key)) BlockRenderActions::forgetByKey($block->key);
        if (! empty($block->group)) BlockRenderActions::forgetByGroup($block->group);
        if (! empty($block->editable)) BlockRenderActions::forgetByModel($block->editable);
    }
}
