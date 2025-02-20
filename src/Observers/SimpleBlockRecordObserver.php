<?php

namespace GIS\EditableBlocks\Observers;

use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;

class SimpleBlockRecordObserver
{
    public function updated(SimpleBlockRecordModelInterface $record): void
    {
        $item = $record->item;
        if (! $item) return;
        $item->touch();
    }
}
