<?php

namespace App\Action;

use App\Models\Lobby;

class ShiftWeights
{
    public static function execute(Lobby $lobby): void
    {
        if (blank($lobby->graph)) {
            $lobby->getGraph();
        } else {
            $lobby->getGraph()->shiftWeights();
            $lobby->save();
        }
    }
}
