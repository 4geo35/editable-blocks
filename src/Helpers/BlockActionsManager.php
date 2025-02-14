<?php

namespace GIS\EditableBlocks\Helpers;

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
        if ($key == "static") return true;
        return ! empty(config("editable-blocks.groups")[$key]);
    }

    public function getAvailableBlocks(string $key): array
    {
        if (! $this->checkIfGroupExists($key)) return [];
        if ($key === "static") return [];
        $groupInfo = config("editable-blocks.groups")[$key];
        $availableTypes = config("editable-blocks.availableTypes");
        if (empty($groupInfo["allowedTypes"])) return $availableTypes;
        $array = [];
        foreach ($groupInfo["allowedTypes"] as $allowedType) {
            if (empty($availableTypes[$allowedType])) continue;
            $array[$allowedType] = $availableTypes[$allowedType];
        }
        return $array;
    }

    public function getTypeTitle(string $key): string
    {
        if (empty(config("editable-blocks.availableTypes")[$key])) return "";
        return config("editable-blocks.availableTypes")[$key];
    }

    public function getBlocksByGroup(string $key): ?Collection
    {
        if (! $this->checkIfGroupExists($key)) return null;
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $query = $blockModelClass::query();
        if ($key === "static") $query->whereNotNull("key");
        else $query->where("group", $key);
        return $query->orderBy("priority")->get();
    }

    public function getComponentByType(string $key): string
    {
        if (! config("editable-blocks.typeComponents")[$key]) return ""; // TODO: make default component with error
        return config("editable-blocks.typeComponents")[$key];
    }
}
