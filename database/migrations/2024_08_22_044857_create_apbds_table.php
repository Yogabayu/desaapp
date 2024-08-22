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
        Schema::create('apbds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_id');
            $table->string('description')->nullable();
            $table->string('amount')->nullable();
            $table->date('date')->nullable();
            $table->enum('type', [1,2,3])->default(1);
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('general_infos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbds');
    }
};
