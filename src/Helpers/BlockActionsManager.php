<?php

namespace GIS\EditableBlocks\Helpers;

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
}
