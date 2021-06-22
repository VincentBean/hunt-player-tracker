<?php

namespace App\Http\Controllers;

use App\Events\UpdateMap;
use App\Models\Lobby;
use Illuminate\Http\Request;

class LobbyController extends Controller
{
    public function publish(string $code)
    {
        $lobby = Lobby::where('code', '=', $code)->first();

        if (is_null($lobby)) {
            return;
        }

        broadcast(new UpdateMap($lobby));
    }

    public function reset(string $code)
    {
        $lobby = Lobby::where('code', '=', $code)->first();

        if (is_null($lobby)) {
            return;
        }

        $lobby->graph = null;
        $lobby->save();

        broadcast(new UpdateMap($lobby));

    }

    public function shiftWeights(string $code)
    {
        $lobby = Lobby::where('code', '=', $code)->first();

        if (blank($lobby->graph)) {
            $lobby->getGraph();
        } else {
            $lobby->getGraph()->shiftWeights();
            $lobby->save();
        }

        broadcast(new UpdateMap($lobby));
    }

    public function exclude(Request $request)
    {
        $lobby = Lobby::where('code', '=', $request->lobby)->first();
        $code = $request->code;

        $graph = $lobby->getGraph();

        $graph->exclude($code);

        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }

    public function include(Request $request)
    {
        $lobby = Lobby::where('code', '=', $request->lobby)->first();
        $code = $request->code;

        $graph = $lobby->getGraph();

        $graph->include($code);

        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }

    public function increaseWeight(Request $request)
    {
        $lobby = Lobby::where('code', '=', $request->lobby)->first();
        $code = $request->code;
        $increase = $request->increase ?? 1;

        $graph = $lobby->getGraph();

        $graph->vertices = $graph->vertices->map(function ($v) use ($code, $increase) {
            if ($v['code'] != $code) {
                return $v;
            }

            $v['weight'] += $increase;

            return $v;
        });

        $lobby->graph = $graph->toJson();
        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }

    public function boss(Request $request)
    {
        $lobby = Lobby::where('code', '=', $request->lobby)->first();
        $code = $request->code;

        $graph = $lobby->getGraph();

        $graph->vertices = $graph->vertices->each(function ($v) use ($graph, $code) {
            if ($v['code'] == $code) {
                $graph->include($code);
            }

            $graph->exclude($code);
        });

        $lobby->graph = $graph->toJson();
        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }
}
