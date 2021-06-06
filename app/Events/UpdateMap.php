<?php

namespace App\Events;

use App\Models\Lobby;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateMap implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Lobby
     */
    protected $lobby;

    public array $edges;

    public function __construct(Lobby $lobby, array $edges)
    {
        $this->lobby = $lobby;
        $this->edges = $edges;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('lobby.'.$this->lobby->code);
    }
}
