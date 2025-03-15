<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = [
            [
                'name' => 'Air Conditioner',
                'room_id' => 3,
                'user_id' => 1,
                'image_id' => 1,
            ],
            [
                'name' => 'Monitor',
                'room_id' => 1,
                'user_id' => 1,
                'image_id' => 2,
            ],
        ];

        foreach ($inventories as $inventory) {
            Inventory::create($inventory);
        }
    }
}
