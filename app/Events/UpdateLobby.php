<?php

namespace App\Events;

use App\Models\Graph;
use App\Models\Lobby;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UpdateLobby implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Lobby $lobby;

    public bool $started;
    public int $minutesLeft;

    public function __construct(Lobby $lobby)
    {
        $this->lobby = $lobby;

        $this->started = isset($lobby->started_at) && !isset($lobby->ended_at);
        $this->minutesLeft = 60 - $lobby->started_at->diffInMinutes(now());

        if ($this->minutesLeft <= 0) {
            LobbyFinished::dispatch($lobby);
        }
    }

    public function broadcastOn(): Channel
    {
        return new Channel('lobby.'.$this->lobby->code);
    }
}
