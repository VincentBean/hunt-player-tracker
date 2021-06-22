<?php

use App\Http\Controllers\LobbyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('tracker');
});

Route::get('/get/{code}', [LobbyController::class, 'publish']);
Route::get('/update/{code}', [LobbyController::class, 'shiftWeights']);
Route::get('/reset/{code}', [LobbyController::class, 'reset']);

Route::post('/vertex/exclude', [LobbyController::class, 'exclude']);
Route::post('/vertex/include', [LobbyController::class, 'include']);
Route::post('/vertex/activity/increaseWeight', [LobbyController::class, 'increaseWeight']);
Route::post('/vertex/activity/boss', [LobbyController::class, 'boss']);
