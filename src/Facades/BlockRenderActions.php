<?php

namespace GIS\EditableBlocks\Facades;

use GIS\EditableBlocks\Helpers\BlockRenderActionsManager;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static BlockModelInterface|null getByKey(string $key)
 * @method static void forgetByKey(string $key)
 *
 * @see BlockRenderActionsManager
 */
class BlockRenderActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "block-render-actions";
    }
}
