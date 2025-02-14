<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use Illuminate\View\View;
use Livewire\Component;

class ImageTextWire extends Component
{
    public BlockModelInterface $block;

    public bool $displayDeleteBlock = false;

    public function render(): View
    {
        return view('eb::livewire.admin.blocks.image-text-wire');
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

    }
}
