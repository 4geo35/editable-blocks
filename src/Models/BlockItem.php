<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BlockItem extends Model implements BlockItemModelInterface
{
    protected $fillable = [
        "title",
        "block_id"
    ];

    public function block(): BelongsTo
    {
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        return $this->belongsTo($blockModelClass);
    }

    public function recordable(): MorphTo
    {
        return $this->morphTo();
    }
}
