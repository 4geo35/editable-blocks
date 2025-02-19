<?php

namespace GIS\EditableBlocks\Traits;

use GIS\EditableBlocks\Interfaces\ShouldBlocksInterface;
use GIS\EditableBlocks\Models\Block;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ShouldBlocks
{
    protected static function bootShouldBlocks(): void
    {
        static::deleted(function (ShouldBlocksInterface $model) {
            $model->clearBlocks();
        });
    }

    public function getBlockGroupAttribute(): string
    {
        return $this->getTable();
    }

    public function getBlockModelClassAttribute(): string
    {
        return config("editable-blocks.customBlockModel") ?? Block::class;
    }

    public function blocks(): MorphMany
    {
        return $this->morphMany($this->block_model_class, "editable");
    }

    public function clearBlocks(): void
    {
        foreach ($this->blocks as $block) {
            $block->delete();
        }
    }
}
