<?php

namespace App\Http\Controllers;

use App\Models\Lobby;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MatchController extends Controller
{
    const ALLOWED_MAPS = ['bayou'];

    public function start(Request $request)
    {
        $request->validate([
            'map' => ['required', Rule::in(self::ALLOWED_MAPS)]
        ]);

        $map = $request->map;
        $code = $request->code ?? Str::random(16);

        if (Lobby::where('code', $code)->first() === null) {
            Lobby::create([
                'code' => $code,
                'started' => false,
                'map' => $map,
                'graph' => '{}'
            ])->newGraph()->save();
        }

        return response()->redirectTo('/tracker');
    }
}
