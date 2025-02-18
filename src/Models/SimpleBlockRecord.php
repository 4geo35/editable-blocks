<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
use GIS\EditableBlocks\Traits\ShouldBlockItem;
use GIS\Fileable\Traits\ShouldImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SimpleBlockRecord extends Model implements SimpleBlockRecordModelInterface
{
    use ShouldBlockItem, ShouldImage;

    protected $fillable = [
        "description",
    ];

    public function getMarkdownAttribute(): ?string
    {
        $value = $this->description;
        if (! $value) return $value;
        return Str::markdown($value);
    }
}
