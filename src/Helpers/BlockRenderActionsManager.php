<?php

namespace GIS\EditableBlocks\Helpers;

use GIS\EditableBlocks\Interfaces\BlockItemModelInterface;
use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Interfaces\SimpleBlockRecordModelInterface;
use GIS\EditableBlocks\Models\Block;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class BlockRenderActionsManager
{
    public function getByKey(string $key): ?BlockModelInterface
    {
        $cacheKey = "static-block:{$key}";
        return Cache::rememberForever($cacheKey, function () use ($key) {
            $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
            $query = $blockModelClass::query();
            $query->with([
                "items" => function (HasMany $many) {
                    $many->with("recordable");
                    $many->orderBy("priority");
                }
            ]);
            $query->where("key", $key);
            $block = $query->first();
            if (! $block) return null;

            foreach ($block->items as $item) {
                $this->callExpandRecordable($item);
            }

            return $block;
        });
    }

    public function forgetByKey(string $key): void
    {
        Cache::forget("static-block:{$key}");
    }

    protected function callExpandRecordable(BlockItemModelInterface $item): void
    {
        if (! $item->recordable) return;
        $explodeRecordClass = explode("\\", $item->recordable::class);
        $className = array_pop($explodeRecordClass);
        $methodName = "expand" . $className;
        // Check if config has custom expand method
        if (! empty(config("editable-blocks.expandRender")[$methodName])) {
            $methodData = config("editable-blocks.expandRender")[$methodName];
            // Check if data is valid
            if (empty($methodData["class"])) return;
            if (empty($methodData["method"])) return;

            $customClass = $methodData["class"];
            if (! class_exists($customClass)) return; // Check if class exists
            $customMethod = $methodData["method"];
            if (method_exists($customClass, "getFacadeRoot")) // Check if class is facade
                $hasMethod = method_exists($customClass::getFacadeRoot(), $customMethod); // Check if facade manager has method
            else $hasMethod = method_exists($customClass, $customMethod); // Check if method exists
            if ($hasMethod) $customClass::$customMethod($item->recordable); // Fire method if exists
        } elseif (method_exists($this, $methodName)) $this->$methodName($item->recordable); // Fire method if exists
    }

    protected function expandSimpleBlockRecord(SimpleBlockRecordModelInterface $record): void
    {
        $record->load("image");
    }
}
