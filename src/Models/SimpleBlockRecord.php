<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
use GIS\EditableBlocks\Traits\ShouldBlockItem;
use GIS\Fileable\Traits\ShouldImage;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SimpleBlockRecord extends Model implements SimpleBlockRecordModelInterface
{
    use ShouldBlockItem, ShouldImage, ShouldMarkdown;

    protected $fillable = [
        "description",
    ];
}
