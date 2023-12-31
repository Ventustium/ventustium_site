<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DiscordWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $time;
    protected $text;

    /**
     * Create a new job instance.
     */
    public function __construct($time, $text)
    {
        $this->time = $time;
        $this->text = $text;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $time = $this->time;
        $text = $this->text;

        $discord_url = env("DISCORD_URL", null);
        $status = '';
        $data = [
            "content" => "$time - $text",
        ];
        while($status != 204){
            try{
                $client = Http::acceptJson()->post($discord_url, $data);
                $status = $client->status();
                echo("Send to Discord Success");
            } catch (Exception $e){
                echo($e);
            }
        }
    }
}
