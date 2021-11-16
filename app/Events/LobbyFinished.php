<?php

namespace App\Events;

use App\Models\Lobby;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LobbyFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Lobby $lobby)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
