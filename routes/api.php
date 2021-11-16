<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/deploy', function(Request $request) {

    $key = config('services.deploy_key');

    if ($key === null) {
        return response('No deployment key set', 500);
    }

    if ($key !== $request->key) {
        abort(404);
    }

    exec("sh " . base_path() . "/deploy.sh &");

    return response('deploying');
});
