<?php

namespace GIS\EditableBlocks\Livewire\Admin\Types;

use GIS\EditableBlocks\Interfaces\SimpleItemActionsInterface;
use GIS\EditableBlocks\Traits\EditBlockTrait;
use GIS\EditableBlocks\Traits\SimpleItemActionsTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class CollapseTextWire extends Component implements SimpleItemActionsInterface
{
    use WithFileUploads, EditBlockTrait, SimpleItemActionsTrait;

    public function rules(): array
    {
        return [
            "title" => ["required", "string", "max:150"],
            "description" => ["required", "string"],
            "image" => ["nullable", "image"],
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
        return view('eb::livewire.admin.types.collapse-text-wire', compact("items"));
    }
}
