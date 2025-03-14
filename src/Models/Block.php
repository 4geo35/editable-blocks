<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlocks\Facades\BlockActions;
use GIS\EditableBlocks\Facades\BlockRenderActions;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Block extends Model implements BlockModelInterface
{
    protected $fillable = [
        "title",
        "render_title",
        "type",
        "group",
        "key",
    ];

    public function items(): HasMany
    {
        $blockItemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        return $this->hasMany($blockItemModelClass);
    }

    public function item(): HasOne
    {
        $blockItemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        return $this->hasOne($blockItemModelClass);
    }

    public function editable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTypeComponentAttribute(): string
    {
        return BlockActions::getComponentByType($this->type);
    }

    public function getRenderTypeComponentAttribute(): string
    {
        return BlockRenderActions::getComponentByType($this->type);
    }
}
