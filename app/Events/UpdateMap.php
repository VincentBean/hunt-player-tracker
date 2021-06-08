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

class UpdateMap implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Lobby $lobby;

    public Collection $vertices;
    public Collection $edges;

    public function __construct(Lobby $lobby)
    {
        $this->lobby = $lobby;
        $graph = $lobby->getGraph();

        $this->vertices = $graph->vertices;
        $this->edges = $graph->edges;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('lobby.'.$this->lobby->code);
    }
}
