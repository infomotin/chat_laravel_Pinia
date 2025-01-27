<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Http\Resources\MessageResource;

class MessageContorller extends Controller
{
    public function index(Room $room, Request $request)
    {
        $messages = $room->messages()->with('user')->latest()->paginate(100);
        // dd($messages);
        return MessageResource::collection($messages);
    }
}
