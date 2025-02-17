<?php

namespace GIS\EditableBlocks\Traits;

trait EditBlockTrait
{
    public function fireEdit(): void
    {
        $this->dispatch("show-edit-block", id: $this->block->id);
    }

    public function fireDelete(): void
    {
        $this->dispatch("show-delete-block", id: $this->block->id);
    }
}
