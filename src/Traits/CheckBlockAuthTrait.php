<?php

namespace GIS\EditableBlocks\Traits;

trait CheckBlockAuthTrait
{
    protected function checkAuth(string $action, bool $useBlock = false): bool
    {
        try {
            $this->authorize($action, $useBlock ? $this->block : $this->block::class);
            return true;
        } catch (\Exception $exception) {
            session()->flash("item-{$this->block->id}-error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }
}
