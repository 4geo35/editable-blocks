<?php

namespace GIS\EditableBlocks\Traits;

use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;

trait DeleteImageTrait
{
    public bool $displayDeleteImage = false;

    public function showClearImage(): void
    {
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("update", true)) return;
        $this->displayDeleteImage = true;
    }

    public function closeClearImage(): void
    {
        $this->displayDeleteImage = false;
    }

    public function clearImage(): void
    {
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("update", true)) return;
        $record = $item->recordable;
        /**
         * @var SimpleBlockRecordModelInterface $record
         */
        $record->clearImage();
        $this->reset("imageUrl", "displayDeleteImage");
        $this->closeClearImage();
    }
}
