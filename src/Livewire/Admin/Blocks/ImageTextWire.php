<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
use GIS\EditableBlocks\Models\BlockItem;
use GIS\EditableBlocks\Models\SimpleBlockRecord;
use GIS\EditableBlocks\Traits\EditBlockTrait;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ImageTextWire extends Component
{
    use WithFileUploads, EditBlockTrait;

    public BlockModelInterface $block;

    public bool $displayDelete = false;
    public bool $displayData = false;

    public int|null $itemId = null;
    public string $title = "";
    public string $description = "";
    public TemporaryUploadedFile|null $image = null;
    public string|null $imageUrl = null;

    public function rules(): array
    {
        $imageRequired = $this->itemId ? "nullable" : "required";
        return [
            "title" => ["required", "string", "max:150"],
            "description" => ["required", "string"],
            "image" => [$imageRequired, "image"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "description" => "Описание",
            "image" => "Изображение",
        ];
    }

    public function render(): View
    {
        $items = $this->block->items()->with("recordable")->orderBy("priority")->get();
        return view('eb::livewire.admin.blocks.image-text-wire', compact("items"));
    }

    #[On("update-block-list")]
    public function freshBlock(int $id): void
    {
        if ($id == $this->block->id) {
            $this->block->fresh();
        }
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showCreate(): void
    {
        $this->resetFields();
        $this->displayData = true;
    }

    public function store(): void
    {
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
        $item = $this->findItem();
        if (! $item) return;
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
        $item = $this->findItem();
        if (! $item) return;
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

    protected function findItem(): ?BlockItemModelInterface
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

    protected function resetFields(): void
    {
        $this->reset("itemId", "title", "description", "image", "imageUrl");
    }
}
