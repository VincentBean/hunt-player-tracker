<?php

namespace App\Console\Commands;

use App\Events\UpdateMap;
use App\Models\Graph;
use App\Models\Lobby;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateLobbies extends Command
{
    protected $signature = 'lobbies:update';

    protected $description = 'Update the lobbies';

    public function handle()
    {
//        broadcast(new UpdateMap(Lobby::first(), $this->getEdges()));

        $this->generateGraph();

        return 0;
    }

    protected function getEdges()
    {
        $compoundRoutes = json_decode(File::get(storage_path('app/data/edges.json')), true);

        $edges = [];

        foreach ($compoundRoutes as $compound => $routes) {
            foreach ($routes as $route) {
                $edges[] = ['from' => $compound, 'to' => $route, 'weight' => 1];
            }
        }

        return $edges;
    }


    protected function generateGraph()
    {
        $graph = new Graph();

        $edges = json_decode(File::get(storage_path('app/data/edges.json')), true);

dd($edges);


    }


}
