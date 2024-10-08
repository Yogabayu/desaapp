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
        Schema::create('umkms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->longText('desc');
            $table->string('tlp')->nullable();
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('general_infos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
