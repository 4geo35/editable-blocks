<?php

namespace GIS\EditableBlocks\Facades;

use GIS\EditableBlocks\Helpers\BlockActionsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @see BlockActionsManager
 */
class BlockActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "block-actions";
    }
}
