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
        Schema::create('village_galleries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_id');
            $table->uuid('type_gallery_id');
            $table->string('name');
            $table->longText('desc');
            $table->string('image');
            $table->boolean('is_show');
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('general_infos');
            $table->foreign('type_gallery_id')->references('id')->on('type_galeries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_galleries');
    }
};
