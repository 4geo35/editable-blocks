<?php

namespace GIS\EditableBlocks\Models;

use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
use GIS\EditableBlocks\Traits\ShouldBlockItem;
use GIS\Fileable\Traits\ShouldImage;
use Illuminate\Database\Eloquent\Model;

class SimpleBlockRecord extends Model implements SimpleBlockRecordModelInterface
{
    use ShouldBlockItem, ShouldImage;

    protected $fillable = [
        "description",
    ];
}
