<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MikrotikDiscordController extends Controller
{
    //
    public function send(Request $request){
        $text = $request->input('text');
        $time = Carbon::now()->toDayDateTimeString();
        if(!$text){
            $text = "$time Empty";
        }
        $discord_url = env("DISCORD_URL", null);
        $status = '';
        $data = [
            "content" => "$time - $text",
        ];
        while($status != 204){
            try{
                $client = Http::acceptJson()->post($discord_url, $data);
                $status = $client->status();
            } catch (Exception $e){

            }
        }

        return ("Success");
    }
}
