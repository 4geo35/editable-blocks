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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("type");
            $table->string("page")->nullable();
            $table->string("key")->unique()->nullable();

            $table->unsignedBigInteger("editable_id")
                ->nullable();
            $table->string("editable_type")
                ->nullable();

            $table->unsignedBigInteger("priority")
                ->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
