<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Facades\BlockActions;
use GIS\EditableBlocks\Interfaces\ShouldBlocksInterface;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class BlockListWire extends Component
{
    public string $currentGroup = "";
    public ShouldBlocksInterface|null $model = null;
    public string $updatedAt = "";

    protected function queryString(): array
    {
        return [
            "currentGroup" => ["as" => "group", "except" => ""],
        ];
    }

    public function mount(): void
    {
        $this->updatedAt = now()->toString();
        if ($this->model) {
            $this->setGroup("model");
        } elseif (empty($this->currentGroup)) {
            $buttons = BlockActions::getGroupButtons();
            if (! empty($buttons)) {
                $this->setGroup($buttons[0]->key);
            }
        }
    }

    public function render(): View
    {
        $blocks = BlockActions::getBlocksByGroup($this->currentGroup, $this->model);
        $updatedTime = $this->updatedAt;
        return view('eb::livewire.admin.blocks.block-list-wire', compact("blocks", "updatedTime"));
    }

    #[On("set-group")]
    public function setGroup(string $key): void
    {
        $this->currentGroup = $key;
    }

    #[On("update-block-list")]
    public function updateList(int $id): void
    {
        $this->updatedAt = now()->toString();
    }

    #[On("delete-block")]
    public function deletedBlock(int $id): void
    {
        $this->updateList($id);
    }
}
