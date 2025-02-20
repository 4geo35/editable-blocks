<?php

namespace GIS\EditableBlocks\Livewire\Admin\Blocks;

use GIS\EditableBlocks\Facades\BlockActions;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Interfaces\ShouldBlocksInterface;
use GIS\EditableBlocks\Models\Block;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ManageBlocksWire extends Component
{
    public bool $hasSearch = false;
    public string $currentGroup = "";
    public ShouldBlocksInterface|null $model = null;

    public bool $displayDelete = false;
    public bool $displayData = false;
    public bool $displayOrder = false;

    public string $type = "";
    public string $typeTitle = "";

    public string $title = "";
    public int|null $blockId = null;

    public Collection|null $blockOrderList = null;

    protected function queryString(): array
    {
        return [
            "currentGroup" => ["as" => "group", "except" => ""],
        ];
    }

    public function mount(): void
    {
        if ($this->model) {
            $this->setGroup("model");
        } elseif (empty($this->currentGroup)) {
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
        $blockList = BlockActions::getAvailableBlocks($this->currentGroup, $this->model);
        return view('eb::livewire.admin.blocks.manage-blocks-wire', compact("blockList"));
    }

    #[On("set-group")]
    public function setGroup(string $key): void
    {
        $this->currentGroup = $key;
    }

    public function showCreate(string $type): void
    {
        $this->resetFields();
        if (! $this->checkAuth("create")) return;

        $this->type = $type;
        $this->typeTitle = BlockActions::getTypeTitle($type);
        $this->displayData = true;
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) return;
        $this->validate();

        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $blockData = [
            "title" => $this->title,
            "type" => $this->type,
        ];
        if ($this->model)
            $block = $this->model->blocks()->create($blockData);
        else {
            $blockData["group"] = $this->currentGroup;
            $block = $blockModelClass::create($blockData);
        }
        $this->dispatch("update-block-list", id: $block->id);
        $this->closeData();
        session()->flash("manage-success", "Блок успешно добавлен");
    }

    #[On("show-edit-block")]
    public function showEdit(int $id): void
    {
        $this->resetFields();
        $this->blockId = $id;
        $block = $this->findBlock();
        if (! $block) return;
        if (! $this->checkAuth("update", $block)) return;

        $this->displayData = true;
        $this->title = $block->title;
        $this->typeTitle = $block->title;
    }

    public function update(): void
    {
        $block = $this->findBlock();
        if (! $block) return;
        if (! $this->checkAuth("update", $block)) return;
        $this->validate();

        $block->update([
            "title" => $this->title
        ]);
        $this->dispatch("update-block-list", id: $block->id);
        $this->closeData();
        session()->flash("manage-success", "Блок успешно обновлен");
    }

    #[On("show-delete-block")]
    public function showDelete(int $id): void
    {
        $this->resetFields();
        $this->blockId = $id;
        $block = $this->findBlock();
        if (! $block) return;
        if (! $this->checkAuth("delete", $block)) return;

        $this->displayDelete = true;
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function confirmDelete(): void
    {
        $block = $this->findBlock();
        if (! $block) return;
        if (! $this->checkAuth("delete", $block)) return;

        $block->delete();
        $this->dispatch("delete-block", id: $block->id);
        $this->closeDelete();
        session()->flash("manage-success", "Блок успешно удален");
    }

    public function showOrder(): void
    {
        $this->resetFields();
        if (! $this->checkAuth("order")) return;
        $this->displayOrder = true;
        $this->blockOrderList = BlockActions::getBlocksByGroup($this->currentGroup, $this->model);
        $this->dispatch("update-list");
    }

    public function closeOrder(): void
    {
        $this->resetFields();
        $this->displayOrder = false;
    }

    public function reorderItems(array $newOrder): void
    {
        if (! $this->checkAuth("order")) return;
        foreach ($newOrder as $priority => $id) {
            $this->blockId = $id;
            $block = $this->findBlock();
            if (! $block) continue;
            $block->priority = $priority;
            $block->save();
        }
        $this->blockOrderList = BlockActions::getBlocksByGroup($this->currentGroup, $this->model);
        $this->dispatch("update-block-list", id: 0);
        $this->dispatch("update-list");
    }

    protected function findBlock(): ?BlockModelInterface
    {
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $block = $blockModelClass::find($this->blockId);
        if (! $block) {
            session()->flash("manage-error", "Блок не найден");
            $this->closeData();
            return null;
        }
        return $block;
    }

    protected function resetFields(): void
    {
        $this->reset("type", "typeTitle", "title", "blockId", "blockOrderList");
    }

    protected function checkAuth(string $action, BlockModelInterface $block = null): bool
    {
        try {
            $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
            $this->authorize($action, $block ?? $blockModelClass);
            return true;
        } catch (\Exception $exception) {
            session()->flash("manage-error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            $this->closeOrder();
            return false;
        }
    }
}
