<?php

namespace GIS\EditableBlocks\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface ShouldBlockItemInterface
{
    public function item(): MorphOne;
}
