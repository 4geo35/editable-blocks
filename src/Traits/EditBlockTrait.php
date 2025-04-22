<?php

namespace GIS\EditableBlocks\Traits;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Models\BlockItem;
use Livewire\Attributes\On;

trait EditBlockTrait
{
    public BlockModelInterface $block;

    #[On("update-block-list")]
    public function freshBlock(int $id): void
    {
        if ($id == $this->block->id) {
            $this->block->fresh();
        }
    }

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
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("delete", true)) return;

        $this->displayDelete = true;
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function confirmDelete(): void
    {
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("delete", true)) return;

        $item->delete();
        $this->closeDelete();
        session()->flash("item-{$this->block->id}-success", "Элемент успешно удален");
    }

    public function moveUp(int $itemId): void
    {
        $this->itemId = $itemId;
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("order")) return;

        $previous = $this->block->items()
            ->where("priority", "<", $item->priority)
            ->orderBy("priority", "desc")
            ->first();

        if ($previous) $this->switchPriority($item, $previous);
    }

    public function moveDown(int $itemId): void
    {
        $this->itemId = $itemId;
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("order")) return;

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

    protected function findModel(): ?BlockItemModelInterface
    {
        $itemModelClass = config("editable-blocks.customBlockItemModel") ?? BlockItem::class;
        $item = $itemModelClass::find($this->itemId);
        if (! $item) {
            session()->flash("item->{$this->block->id}-error", "Элемент не найден");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $item;
    }
}
