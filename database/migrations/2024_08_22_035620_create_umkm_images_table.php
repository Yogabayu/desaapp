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
        Schema::create('umkm_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('umkm_id');
            $table->string('image');
            $table->timestamps();

            $table->foreign('umkm_id')->references('id')->on('umkms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_images');
    }
};
