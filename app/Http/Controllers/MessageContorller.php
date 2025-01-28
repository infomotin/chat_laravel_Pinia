<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Http\Resources\MessageResource;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;

class MessageContorller extends Controller
{
    public function index(Room $room, Request $request)
    {
        $messages = $room->messages()->with('user')->latest()->paginate(100);
        // dd($messages);
        return MessageResource::collection($messages);
    }
    //store message
    public function store(StoreMessageRequest $request,Room $room)
    {
        // dd($request->validated(), $room);
        $messages = $room->messages()->make($request->validated());
        $messages->user()->associate(Auth::user());
        $messages->save();
        return MessageResource::make($messages);
    }
}
