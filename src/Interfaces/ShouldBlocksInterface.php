<?php

namespace GIS\EditableBlocks\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ShouldBlocksInterface
{
    public function blocks(): MorphMany;
    public function clearBlocks(): void;
}
