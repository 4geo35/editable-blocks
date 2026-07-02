<?php

namespace GIS\EditableBlocks\Interfaces;

use ArrayAccess;
use GIS\EditableBlockButtons\Interfaces\ShouldButtonsInterface;
use GIS\EditableBlockTexts\Interfaces\ShouldTextsInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use JsonSerializable;
use Stringable;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;

interface BlockItemModelInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable,
    ShouldButtonsInterface, ShouldTextsInterface
{
    public function block(): BelongsTo;
    public function recordable(): MorphTo;
}
