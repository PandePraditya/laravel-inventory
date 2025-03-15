<?php

namespace Database\Seeders;

use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['url' => 'https://picsum.photos/500/500?random=1'],
            ['url' => 'https://picsum.photos/500/500?random=2'],
            ['url' => 'https://picsum.photos/500/500?random=3'],
            ['url' => 'https://picsum.photos/500/500?random=4'],
            ['url' => 'https://picsum.photos/500/500?random=5'],
        ];

        foreach ($images as $image) {
            Image::create($image);
        }
    }
}
