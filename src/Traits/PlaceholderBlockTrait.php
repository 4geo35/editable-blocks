<?php

namespace GIS\EditableBlocks\Traits;

use Illuminate\View\View;

trait PlaceholderBlockTrait
{
    public function placeholder(): View
    {
        return view("tt::admin.wire-placeholder", ["wirePlaceholderTitle" => "Загрузка блока {$this->block->title}"]);
    }
}
