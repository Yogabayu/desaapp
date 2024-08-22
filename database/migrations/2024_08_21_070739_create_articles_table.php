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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_id');
            $table->uuid('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->date('publish_date');
            $table->string('thumbnail');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('general_infos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
