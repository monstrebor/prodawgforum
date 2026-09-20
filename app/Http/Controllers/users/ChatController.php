<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())
            ->orderBy('username', 'asc')
            ->get();

        return view('chat.index', compact('users'));
    }


    public function sendMessage(Request $request)
    {
        $request->validate([
            'room_id' => 'required|integer',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'message' => $request->message,
        ]);

        $redisKey = "chats:room:{$request->room_id}";

        Redis::rpush($redisKey, json_encode($message));
        Redis::ltrim($redisKey, -50, -1);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'status' => 'Message sent!',
            'message' => $message,
        ]);
    }


    public function getChatHistory($roomId)
    {
        $redisKey = "chats:room:{$roomId}";

        $cachedMessages = Redis::lrange($redisKey, 0, -1);

        if (!empty($cachedMessages)) {
            return response()->json(
                array_map(
                    fn ($message) => json_decode($message),
                    $cachedMessages
                )
            );
        }

        $messages = Message::where('room_id', $roomId)
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        foreach ($messages as $message) {
            Redis::rpush($redisKey, json_encode($message));
        }

        return response()->json($messages);
    }
}
