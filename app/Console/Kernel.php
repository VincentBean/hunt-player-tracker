<?php

namespace App\Console;

use App\Console\Commands\UpdateLobbies;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        UpdateLobbies::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(UpdateLobbies::class)->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
