<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('general_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('fb')->nullable();
            $table->string('wa')->nullable();
            $table->string('ig')->nullable();
            $table->string('ytb')->nullable();
            $table->string('email');
            $table->string('web')->nullable();
            $table->string('tlp');
            $table->longText('short_desc');
            $table->longText('long_desc');
            $table->string('logo')->nullable();
            $table->string('general_image')->nullable();
            $table->string('area');
            $table->string('total_population');
            $table->string('total_dusun');
            $table->string('total_rt');
            $table->string('total_umkm');
            $table->string('fasilities');
            $table->string('general_work');
            $table->longText('visi');
            $table->longText('misi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('general_infos');
    }
};