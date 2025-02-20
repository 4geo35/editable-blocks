<?php

namespace GIS\EditableBlocks\Helpers;

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
                if (! $item->recordable) continue;
                $explodeRecordClass = explode("\\", $item->recordable::class);
                $className = array_pop($explodeRecordClass);
                $methodName = "expand" . $className;
                if (method_exists($this, $methodName)) $this->$methodName($item->recordable);
            }

            return $block;
        });
    }

    protected function expandSimpleBlockRecord(SimpleBlockRecordModelInterface $record): void
    {
        $record->load("image");
    }
}
