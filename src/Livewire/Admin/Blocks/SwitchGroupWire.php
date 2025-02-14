<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Facades\BlockActions;
use Illuminate\View\View;
use Livewire\Component;

class SwitchGroupWire extends Component
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
        $buttons = BlockActions::getGroupButtons();
        return view('eb::livewire.admin.blocks.switch-group-wire', compact("buttons"));
    }

    public function setGroup(string $key): void
    {
        if (! BlockActions::checkIfGroupExists($key)) {
            session()->flash("group-error", "Группа не найдена");
            $this->resetFields();
            $this->dispatch("set-group", key: "");
            return;
        }
        if ($this->currentGroup == $key) return;
        $this->currentGroup = $key;
        $this->dispatch("set-group", key: $key);
    }

    protected function resetFields(): void
    {
        $this->reset("currentGroup");
    }
}
