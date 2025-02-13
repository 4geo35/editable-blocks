<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Block extends Model implements BlockModelInterface
{
    protected $fillable = [
        "title",
        "type",
        "page",
        "key",
    ];

    public function items(): HasMany
    {
        $blockItemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        return $this->hasMany($blockItemModelClass);
    }
}
