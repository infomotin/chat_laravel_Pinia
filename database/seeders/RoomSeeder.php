<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $rooms = [
            ['title' => 'General',
            'slug' => 'general',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            ['title' => 'Random',
            'slug' => 'random',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            ['title' => 'Laravel',
            'slug' => 'laravel',
            'created_at' => now(),
            'updated_at' => now(),
            ]
            
        ];

        Room::insert($rooms);
    }
}
