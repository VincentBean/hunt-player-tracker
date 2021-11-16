<?php

namespace App\Listeners;

use App\Events\LobbyFinished;
use App\Events\UpdateLobby;
use App\Events\UpdateMap;

class LobbyFinish
{
    public function handle(LobbyFinished $event): void
    {
        $lobby = $event->lobby;

        $lobby->ended_at = now();
        $lobby->started = false;
        $lobby->save();

        broadcast(new UpdateMap($lobby));
        broadcast(new UpdateLobby($lobby));
    }
}
