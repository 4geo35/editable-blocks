<?php

namespace GIS\EditableBlocks\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlockController extends Controller
{
    public function index(): View
    {
        return view("eb::admin.blocks.index");
    }
}
