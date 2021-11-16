<?php

namespace App\Console\Commands;

use App\Models\Lobby;
use Illuminate\Console\Command;

class CleanupLobbies extends Command
{
    protected $signature = 'lobbies:cleanup';

    protected $description = 'Delete old lobbies';

    public function handle()
    {
        Lobby::query()
            ->where('ended_at', '!=', null)
            ->where('started', false)
            ->delete();

        return 0;
    }
}
