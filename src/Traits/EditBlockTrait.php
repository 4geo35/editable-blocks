<?php

namespace GIS\EditableBlocks\Traits;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;

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

    public function showDelete(int $id): void
    {
        $this->resetFields();
        $this->itemId = $id;
        $item = $this->findItem();
        if (! $item) return;

        $this->displayDelete = true;
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function confirmDelete(): void
    {
        $item = $this->findItem();
        if (! $item) return;

        $item->delete();
        $this->closeDelete();
        session()->flash("item-{$this->block->id}-success", "Элемент успешно удален");
    }

    public function moveUp(int $itemId): void
    {
        $this->itemId = $itemId;
        $item = $this->findItem();
        if (! $item) return;

        $previous = $this->block->items()
            ->where("priority", "<", $item->priority)
            ->orderBy("priority", "desc")
            ->first();

        if ($previous) $this->switchPriority($item, $previous);
    }

    public function moveDown(int $itemId): void
    {
        $this->itemId = $itemId;
        $item = $this->findItem();
        if (! $item) return;

        $previous = $this->block->items()
            ->where("priority", ">", $item->priority)
            ->orderBy("priority")
            ->first();

        if ($previous) $this->switchPriority($item, $previous);
    }

    protected function switchPriority(BlockItemModelInterface $item, BlockItemModelInterface $target): void
    {
        $buff = $target->priority;
        $target->priority = $item->priority;
        $target->save();

        $item->priority = $buff;
        $item->save();
    }
}
