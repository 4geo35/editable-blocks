<?php

namespace GIS\EditableBlocks\Templates;


use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ModifierInterface;

class ImageTextRecord implements ModifierInterface
{
    public function apply(ImageInterface $image): ImageInterface
    {
        return $image->cover(672, 414);
    }
}
