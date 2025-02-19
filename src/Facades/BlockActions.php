<?php

namespace GIS\EditableBlocks\Facades;

use GIS\EditableBlocks\Helpers\BlockActionsManager;
use GIS\EditableBlocks\Interfaces\ShouldBlocksInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getGroupButtons()
 * @method static bool checkIfGroupExists(string $key)
 * @method static array getAvailableBlocks(string $key, ShouldBlocksInterface $model = null)
 * @method static string getTypeTitle(string $key)
 * @method static Collection|null getBlocksByGroup(string $key)
 * @method static string getComponentByType(string $key)
 *
 * @see BlockActionsManager
 */
class BlockActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "block-actions";
    }
}
