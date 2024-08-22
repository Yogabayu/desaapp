<?php

namespace Database\Seeders;

use App\Models\Apbd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApbdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apbd::factory(2)->create();
    }
}
