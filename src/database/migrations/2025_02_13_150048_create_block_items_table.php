<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('block_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("block_id");
            $table->string("title");
            $table->unsignedBigInteger("priority")
                ->default(1);
            $table->unsignedBigInteger("recordable_id");
            $table->string("recordable_type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_items');
    }
};
