<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Facades\BlockActions;
use GIS\EditableBlocks\Models\Block;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ManageBlocksWire extends Component
{
    public string $currentGroup = "";

    public bool $displayCreate = false;
    public string $type = "";
    public string $typeTitle = "";

    public string $title = "";

    protected function queryString(): array
    {
        return [
            "currentGroup" => ["as" => "group", "except" => ""],
        ];
    }

    public function mount(): void
    {
        if (empty($this->currentGroup)) {
            $buttons = BlockActions::getGroupButtons();
            if (! empty($buttons)) {
                $this->setGroup($buttons[0]->key);
            }
        }
    }

    public function rules(): array
    {
        return [
            "title" => ["nullable", "string", "max:150"]
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок"
        ];
    }

    public function render(): View
    {
        $blockList = BlockActions::getAvailableBlocks($this->currentGroup);
        return view('eb::livewire.admin.blocks.manage-blocks-wire', compact("blockList"));
    }

    #[On("set-group")]
    public function setGroup(string $key): void
    {
        $this->currentGroup = $key;
    }

    public function showCreate(string $type): void
    {
        $this->type = $type;
        $this->typeTitle = BlockActions::getTypeTitle($type);
        $this->displayCreate = true;
    }

    public function closeCreate(): void
    {
        $this->resetFields();
        $this->displayCreate = false;
    }

    public function store(): void
    {
        $this->validate();
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $block = $blockModelClass::create([
            "title" => $this->title,
            "type" => $this->type,
            "group" => $this->currentGroup,
        ]);
        $this->dispatch("create-new-block", id: $block->id);
        $this->closeCreate();
        session()->flash("manage-success", "Блок успешно добавлен");
    }

    protected function resetFields(): void
    {
        $this->reset("type", "typeTitle");
    }
}
