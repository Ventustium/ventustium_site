<?php

use App\Http\Controllers\MikrotikDiscordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});
Route::get('/grandchase', function() {
	return view('grandchase');
});
Route::get('/mikrotik-notification/'.env("DISCORD_KEY"), [MikrotikDiscordController::class, 'send']);
Route::get('/redis/{id}', [MikrotikDiscordController::class, 'show']);
