<?php

use App\Http\Controllers\LobbyController;
use App\Http\Controllers\MatchController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'));
Route::get('/map', fn() => view('map'));
Route::post('/start', [MatchController::class, 'start']);

Route::get('/tracker', fn () => view('tracker'));

Route::get('/get/{code}', [LobbyController::class, 'publish']);
Route::get('/update/{code}', [LobbyController::class, 'shiftWeights']);
Route::get('/reset/{code}', [LobbyController::class, 'reset']);

Route::post('/vertex/exclude', [LobbyController::class, 'exclude']);
Route::post('/vertex/include', [LobbyController::class, 'include']);
Route::post('/vertex/activity/increaseWeight', [LobbyController::class, 'increaseWeight']);
Route::post('/vertex/activity/boss', [LobbyController::class, 'boss']);
Route::post('/vertex/area', [LobbyController::class, 'markArea']);
