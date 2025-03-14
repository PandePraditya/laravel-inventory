<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['id' => 1, 'name' => 'Frontend Developer'],
            ['id' => 2, 'name' => 'Backend Developer'],
        ];
        
        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
