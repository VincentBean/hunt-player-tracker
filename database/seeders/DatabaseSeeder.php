<?php

namespace Database\Seeders;

use App\Models\Lobby;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Lobby::create([
           'code' => 'lob'
        ]);
    }
}
