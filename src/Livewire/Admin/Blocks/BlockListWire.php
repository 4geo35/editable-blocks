<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Facades\BlockActions;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class BlockListWire extends Component
{
    public string $currentGroup = "";

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

    public function render(): View
    {
        $blocks = BlockActions::getBlocksByGroup($this->currentGroup);
        return view('eb::livewire.admin.blocks.block-list-wire', compact("blocks"));
    }

    #[On("set-group")]
    public function setGroup(string $key): void
    {
        $this->currentGroup = $key;
    }
}
