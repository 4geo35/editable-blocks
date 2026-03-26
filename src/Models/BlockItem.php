<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlockButtons\Models\BlockButton;
use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function buttons(): HasMany
    {
        if (config("editable-block-buttons")) {
            $modelClass = config("editable-block-buttons.customBlockButtonModel") ?? BlockButton::class;
            return $this->hasMany($modelClass, "item_id");
        } else {
            return new HasMany($this->newQuery(), $this, "", "");
        }
    }

    public function orderedButtons(): HasMany
    {
        return $this->buttons()->orderBy("priority");
    }
}
