<?php

namespace Database\Seeders;

use App\Models\TypeGalery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeGalerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeGalery::factory()->count(5)->create();
    }
}
