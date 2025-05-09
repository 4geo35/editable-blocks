<?php

namespace GIS\EditableBlocks\Traits;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
use GIS\EditableBlocks\Models\BlockItem;
use GIS\EditableBlocks\Models\SimpleBlockRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait SimpleItemActionsTrait
{
    public bool $displayDelete = false;
    public bool $displayData = false;

    public int|null $itemId = null;
    public string $title = "";
    public string $description = "";
    public TemporaryUploadedFile|null $image = null;
    public string|null $imageUrl = null;

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showCreate(): void
    {
        $this->resetFields();
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("create")) return;
        $this->displayData = true;
    }

    public function store(): void
    {
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("create")) return;
        $this->validate();

        $simpleRecordModelClass = config("editable-blocks.customSimpleBlockRecordModel") ?? SimpleBlockRecord::class;
        $record = $simpleRecordModelClass::create([
            "description" => $this->description,
        ]);
        /**
         * @var SimpleBlockRecordModelInterface $record
         */
        $record->livewireImage($this->image);
        $record->item()->create([
            "title" => $this->title,
            "block_id" => $this->block->id,
        ]);

        $this->closeData();
        session()->flash("item-{$this->block->id}-success", "Элемент успешно добавлен");
    }

    public function showEdit(int $id): void
    {
        $this->resetFields();
        $this->itemId = $id;
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("update", true)) return;
        $record = $item->recordable;

        $this->title = $item->title;
        $this->description = $record->description;
        if ($record->image_id) {
            $record->load("image");
            $this->imageUrl = $record->image->storage;
        } else $this->imageUrl = null;
        $this->displayData = true;
    }

    public function update(): void
    {
        $item = $this->findModel();
        if (! $item) return;
        if (method_exists($this, "checkAuth") && ! $this->checkAuth("update", true)) return;
        $record = $item->recordable;
        /**
         * @var SimpleBlockRecordModelInterface $record
         */
        $this->validate();
        $record->update([
            "description" => $this->description
        ]);
        $record->livewireImage($this->image);
        $item->update([
            "title" => $this->title,
        ]);

        $this->closeData();
        session()->flash("item-{$this->block->id}-success", "Элемент успешно обновлен");
    }

    protected function resetFields(): void
    {
        $this->reset("itemId", "title", "description", "image", "imageUrl");
    }
}
