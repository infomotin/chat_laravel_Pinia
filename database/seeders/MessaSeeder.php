<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class MessaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::factory()->count(1000)
        // ->sequence(
        //     ['user_id' => User::where('email', 'admin@example.com')->first()->id, 'room_id' => Room::where('name', 'general')->first()->id],
        //     ['user_id' => User::where('email', 'user@example.com')->first()->id, 'room_id' => Room::where('name', 'general')->first()->id],
        //     ['user_id' => User::where('email', 'bob@example.com')->first()->id, 'room_id' => Room::where('name', 'general')->first()->id],
        //     ['user_id' => User::where('email', 'alice@example.com')->first()->id, 'room_id' => Room::where('name', 'general')->first()->id],
        // )
        ->sequence(
            function(Sequence $sequence) {
                return [
                    'content' =>"Message #" . $sequence->index,
                    'user_id' => User::inRandomOrder()->first()->id,
                    'room_id' => Room::inRandomOrder()->first()->id,
                    'created_at' => now()->subYear()->addHour($sequence->index),
                    'updated_at' => now()->subMinutes(1000 - $sequence->index),
                ];

            }
        ) 
        ->create();
    }
}
