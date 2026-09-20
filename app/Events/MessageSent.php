<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    // This dictates the private channel name
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->room_id);
    }

    // The data sent across the WebSocket
    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message,
            'user_id' => $this->message->user_id,
            'created_at' => $this->message->created_at->toIso8601String(),
        ];
    }
}
