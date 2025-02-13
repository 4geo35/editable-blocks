<?php

use Illuminate\Support\Facades\Route;
use GIS\EditableBlocks\Http\Controllers\Admin\BlockController;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("blocks")
            ->as("blocks.")
            ->group(function () {
                $adminBlockController = config("editable-blocks.customAdminBlockController") ?? BlockController::class;
                Route::get("/", [$adminBlockController, "index"])->name("index");
            });
    });
