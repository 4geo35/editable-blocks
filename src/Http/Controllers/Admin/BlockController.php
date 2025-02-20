<?php

namespace GIS\EditableBlocks\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GIS\EditableBlocks\Models\Block;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BlockController extends Controller
{
    public function index(): View
    {
        $blockModelClass = config("editable-blocks.customBlockModel") ?? Block::class;
        Gate::authorize("viewAny", $blockModelClass);
        return view("eb::admin.blocks.index");
    }
}
