<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [ 
                'name' => 'Jakarta'
            ],
            [ 
                'name' => 'Bali'
            ],
            [ 
                'name' => 'Tokyo'
            ],
            [ 
                'name' => 'Cairo'
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
