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

        $graph->calculatePercentages();

        $lobby->graph = $graph->toJson();
        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }

    public function boss(Request $request)
    {
        $lobby = Lobby::where('code', '=', $request->lobby)->first();
        $code = $request->code;

        $graph = $lobby->getGraph();

        // exclude all not except $code in the same area
        $bossVertex = $graph->vertices->where('code', $code)->first();

        foreach ($graph->vertices as $v) {
            if ($v['code'] == $bossVertex['code']) {
                $graph->include($bossVertex['code']);
                continue;
            }

            if ($v['area'] == $bossVertex['area']) {
                $graph->exclude($v['code']);
            }
        }

        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }

    public function markArea(Request $request)
    {
        $lobby = Lobby::where('code', '=', $request->lobby)->first();
        $code = $request->code;
        $area = $request->area;

        $graph = $lobby->getGraph();

        $graph->vertices = $graph->vertices->map(function ($v) use ($code, $area) {
            if ($v['code'] != $code) {
                return $v;
            }

            $v['area'] = $area;

            return $v;
        });

        $lobby->graph = $graph->toJson();
        $lobby->save();

        broadcast(new UpdateMap($lobby));
    }
}
