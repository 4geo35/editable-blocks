<?php

namespace GIS\EditableBlocks\Facades;

use GIS\EditableBlocks\Helpers\BlockRenderActionsManager;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string getComponentByType(string $key)
 *
 * @method static BlockModelInterface|null getByKey(string $key)
 * @method static void forgetByKey(string $key)
 *
 * @method static Collection|null getByGroup(string $key)
 * @method static void forgetByGroup(string $key)
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
