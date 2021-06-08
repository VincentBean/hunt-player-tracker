<?php

namespace App\Console\Commands;

use App\Events\UpdateMap;
use App\Models\Lobby;
use Illuminate\Console\Command;

class UpdateLobbies extends Command
{
    protected $signature = 'lobbies:update';

    protected $description = 'Update the lobbies';

    public function handle()
    {
        $lobby = Lobby::first();

        broadcast(new UpdateMap($lobby));

        return 0;
    }
}
