<?php

namespace App\Http\Controllers;

use App\Events\UpdateMap;
use App\Models\Lobby;
use Illuminate\Http\Request;

class LobbyController extends Controller
{
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

        $graph->vertices = $graph->vertices->map(function($v) use ($code) {
            if ($v['code'] != $code) return $v;

            $v['excluded'] = true;

            return $v;
        });

        $graph->edges = $graph->edges->map(function($e) use ($code) {

            if ($e['a'] == $code) {
                $e['dir'] = '>';
            }

            if ($e['b'] == $code) {
                $e['dir'] = '<';
            }

            return $e;
        });

        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }
}
