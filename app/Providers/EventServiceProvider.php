<?php

namespace App\Providers;

use App\Events\LobbyFinished;
use App\Listeners\LobbyFinish;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LobbyFinished::class => [
            LobbyFinish::class
        ]
    ];

    public function boot()
    {
        //
    }
}
