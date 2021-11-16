<?php

namespace App\Console\Commands;

use App\Action\ShiftWeights;
use App\Events\UpdateLobby;
use App\Events\UpdateMap;
use App\Models\Lobby;
use Illuminate\Console\Command;

class UpdateLobbies extends Command
{
    protected $signature = 'lobbies:update';

    protected $description = 'Shift graph weights and broadcast';

    public function handle()
    {
        Lobby::active()->each(function(Lobby $lobby) {

            ShiftWeights::execute($lobby);

            broadcast(new UpdateMap($lobby));
            broadcast(new UpdateLobby($lobby));

        });

        return Command::SUCCESS;
    }
}
