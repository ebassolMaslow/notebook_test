<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sketchpad;

class SketchpadSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     * 
     * @return void */
    public function run(): void
    {
        Sketchpad::truncate();
        Sketchpad::factory()
            ->count(10)
            ->create();
    }
}
