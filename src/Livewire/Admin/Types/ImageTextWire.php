<?php

namespace GIS\EditableBlocks\Livewire\Admin\Types;

use GIS\EditableBlocks\Interfaces\SimpleItemActionsInterface;
use GIS\EditableBlocks\Traits\EditBlockTrait;
use GIS\EditableBlocks\Traits\SimpleItemActionsTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageTextWire extends Component implements SimpleItemActionsInterface
{
    use WithFileUploads, EditBlockTrait, SimpleItemActionsTrait;

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
        return view('eb::livewire.admin.types.image-text-wire', compact("items"));
    }
}
