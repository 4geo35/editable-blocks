<?php

namespace GIS\EditableBlocks\Commands;

use GIS\EditableBlocks\Interfaces\BlockModelInterface;
use GIS\EditableBlocks\Models\Block;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class CreateBlocksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eb:blocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update blocks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->checkGroups();
        $this->checkStatic();
    }

    protected function checkStatic(): void
    {
        $this->createOrUpdateBlocks();
        $staticKeys = array_keys(config("editable-blocks.static"));
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $query = $blockModelClass::query()
            ->whereNotNull("key");
        if (! empty($staticKeys)) $query->whereNotIn("key", $staticKeys);
        $blocks = $query->get();

        $this->deleteBlocks($blocks, "ключ", "ключом", "key");
    }

    protected function createOrUpdateBlocks(): void
    {
        if (empty(config("editable-blocks.static"))) return;
        $staticBlocks = config("editable-blocks.static");
        foreach ($staticBlocks as $key => $item) {
            $block = $this->findBlockByKey($key);
            if ($block) {
                $type = $item["type"];
                if ($block->type !== $item["type"]) {
                    if (
                        $this->confirm("Тип блока {$block->title}:{$block->key} был изменен на {$type}. При изменении типа блока будут удалены все элементы, Вы уверены?")
                    ) {
                        foreach ($block->items as $bItem) {
                            $bItem->delete();
                        }
                    } else $type = $block->type;
                }
                $block->update([
                    "title" => $item["title"],
                    "type" => $type
                ]);
            } else {
                $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
                $block = $blockModelClass::create([
                    "title" => $item["title"],
                    "key" => $key,
                    "type" => $item["type"],
                ]);
                $this->info("Добавлен блок {$block->title}:{$block->key}.");
            }
        }
    }

    protected function findBlockByKey(string $key): ?BlockModelInterface
    {
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $block = $blockModelClass::query()
            ->where("key", $key)
            ->first();
        if (! $block) return null;
        return $block;
    }

    protected function checkGroups(): void
    {
        $groupKeys = array_keys(config("editable-blocks.groups"));
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        $query = $blockModelClass::query()
            ->whereNotNull("group");
        if (! empty($groupKeys)) $query->whereNotIn("group", $groupKeys);
        $blocks = $query->get();

        $this->deleteBlocks($blocks, "группа", "группой", "group");
    }

    protected function deleteBlocks(Collection $blocks, string $firstQuestion, string $secondQuestion, string $col): void
    {
        if (! $blocks->count()) return;

        if (
            $this->confirm("Удалить все блоки, {$firstQuestion} которых отсутствует в конфигурации?")
        ) $deleteAll = true;
        else $deleteAll = false;

        $count = $blocks->count();
        foreach ($blocks as $block) {
            if (
                ! $deleteAll &&
                ! $this->confirm("Удалить блок {$block->title} с {$secondQuestion} " . $block->{$col})
            ) {
                $count--;
                continue;
            }
            $block->delete();
        }
        $this->info("Было удалено {$count} " . num2word($count, ["блок", "блока", "блоков"]));
    }
}
