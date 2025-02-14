<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use Illuminate\View\View;
use Livewire\Component;

class ImageTextWire extends Component
{
    public BlockModelInterface $block;

    public function render(): View
    {
        return view('eb::livewire.admin.blocks.image-text-wire');
    }
}
