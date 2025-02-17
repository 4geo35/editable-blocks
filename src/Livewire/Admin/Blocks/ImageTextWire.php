<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
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

    public bool $displayDeleteBlock = false;
    public bool $displayData = false;

    public int|null $itemId = null;
    public string $title = "";
    public string $description = "";
    public TemporaryUploadedFile|null $image = null;
    public string|null $imageUrl = null;

    public function rules(): array
    {
        return [
            "title" => ["required", "string", "max:150"],
            "description" => ["required", "string"],
            "image" => ["required", "image"],
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
        return view('eb::livewire.admin.blocks.image-text-wire');
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

    public function showDeleteBlock(): void
    {
        $this->displayDeleteBlock = true;
    }

    public function closeDeleteBlock(): void
    {
        $this->displayDeleteBlock = false;
    }

    public function confirmDeleteBlock(): void
    {
        $this->block->delete();
        $this->dispatch("delete-block", id: $this->block->id);
    }

    protected function resetFields(): void
    {
        $this->reset("itemId", "title", "description", "image", "imageUrl");
    }
}
