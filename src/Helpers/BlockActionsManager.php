<?php

namespace GIS\EditableBlocks\Helpers;

use GIS\EditableBlocks\Interfaces\ShouldBlocksInterface;
use GIS\EditableBlocks\Models\Block;
use Illuminate\Database\Eloquent\Collection;

class BlockActionsManager
{
    public function getGroupButtons(): array
    {
        $array = [];
        if (! empty(config("editable-blocks.static"))) {
            $array[] = (object) [
                "title" => "Фиксированные",
                "key" => "static",
            ];
        }
        if (! empty(config("editable-blocks.groups"))) {
            foreach (config("editable-blocks.groups") as $key => $item) {
                $array[] = (object) [
                    "title" => $item["title"],
                    "key" => $key,
                ];
            }
        }
        return $array;
    }

    public function checkIfGroupExists(string $key): bool
    {
        if (in_array($key, ["static", "model"])) return true;
        return ! empty(config("editable-blocks.groups")[$key]);
    }

    public function checkIfModelExists(ShouldBlocksInterface $model): bool
    {
        return isset(config("editable-blocks.models")[$model->block_group]);
    }

    public function getAvailableBlocks(string $key, ShouldBlocksInterface $model = null): array
    {
        if ($model && ! $this->checkIfModelExists($model)) return [];
        if (! $this->checkIfGroupExists($key)) return [];
        if ($key === "static") return [];

        $groupInfo = $model ?
            config("editable-blocks.models")[$model->block_group] :
            config("editable-blocks.groups")[$key];

        $availableTypes = config("editable-blocks.availableTypes");
        if (! empty(config("editable-blocks.customAvailableTypes"))) {
            $availableTypes = array_merge($availableTypes, config("editable-blocks.customAvailableTypes"));
        }
        if (empty($groupInfo["allowedTypes"])) { return $availableTypes; }

        $array = [];
        foreach ($groupInfo["allowedTypes"] as $allowedType) {
            if (empty($availableTypes[$allowedType])) continue;
            $array[$allowedType] = $availableTypes[$allowedType];
        }
        return $array;
    }

    public function getTypeTitle(string $key): string
    {
        if (! empty(config("editable-blocks.availableTypes")[$key]["title"])) {
            return config("editable-blocks.availableTypes")[$key]["title"];
        }
        if (! empty(config("editable-blocks.customAvailableTypes")[$key])) {
            return config("editable-blocks.customAvailableTypes")[$key]["title"];
        }
        return "";
    }

    public function getBlocksByGroup(string $key, ShouldBlocksInterface $model = null): ?Collection
    {
        if ($model && ! $this->checkIfModelExists($model)) return null;
        if (! $this->checkIfGroupExists($key)) return null;

        if ($model) $query = $model->blocks();
        else {
            $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
            $query = $blockModelClass::query();
        }
        if ($key === "static") $query->whereNotNull("key");
        elseif (! $model) $query->where("group", $key);
        if ($key === "static") return $query->orderBy("title")->get();
        return $query->orderBy("priority")->get();
    }

    public function getComponentByType(string $key): string
    {
        if (! empty(config("editable-blocks.availableTypes")[$key]["admin"])) {
            return config("editable-blocks.availableTypes")[$key]["admin"];
        }
        if (! empty(config("editable-blocks.customAvailableTypes")[$key]["admin"])) {
            return config("editable-blocks.customAvailableTypes")[$key]["admin"];
        }
        return ""; // TODO: make default component with error
    }
}
