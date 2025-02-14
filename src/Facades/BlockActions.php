<?php

namespace GIS\EditableBlocks\Facades;

use GIS\EditableBlocks\Helpers\BlockActionsManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getGroupButtons()
 * @method static bool checkIfGroupExists(string $key)
 * @method static array getAvailableBlocks(string $key)
 * @method static string getTypeTitle(string $key)
 * @method static Collection|null getBlocksByGroup(string $key)
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
