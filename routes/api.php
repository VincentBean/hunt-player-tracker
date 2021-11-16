<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/deploy', function(Request $request) {

    $sig_check = 'sha1=' . hash_hmac('sha1', $request->getContent(), config('services.deploy_key'));

    if ($sig_check !== $request->header('x-hub-signature')) {  // php >=5.6 and above should use hash_equals() for comparison
        \Log::info('MATCH');
    }
    \Log::info('FAIL');


    return response('deploying');
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
