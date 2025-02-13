<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("blocks")
            ->as("blocks.")
            ->group(function () {
                Route::get("/", function () {
                    return "blocks";
                })->name("index");
            });
    });
