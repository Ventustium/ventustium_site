<?php

namespace App\Http\Controllers;

use App\Jobs\DiscordWebhook;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class MikrotikDiscordController extends Controller
{
    //
    public function send(Request $request) {
	$time = Carbon::now()->format('D, M j, Y g:i:s A');

        $text = $request->input('text');

        if(!$text){
            $text = "$time Empty";
        }
        DiscordWebhook::dispatch($time, $text);
        return ("Success");
    }
}
