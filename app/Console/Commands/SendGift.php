<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\GiftDetail;
use Redis;
use GuzzleHttp\Client;

class SendGift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:sendgift';
    protected $numberLoop = 100;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send gift of each user to Game Server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $requests = Redis::hgetall('receiveGifts');
        foreach ($requests as $user_id => $gift_id) {
            if (!$this->numberLoop--) break;
            $data = array('user_id'=> $user_id, 'gift_id'=> $gift_id);
            $res = $this->postRequest(env('SERVER_GAME'), $data);

            Redis::hdel('receiveGifts', $user_id);
            if (json_decode($res)=="ok") {
                GiftDetail::updateByUserId($user_id, ['receive_gift'=>1]);
                \Log::info(" GiftDetail ".$user_id." updated successfull.");
            }
            else {
                Redis::hsetnx('receiveGifts', $user_id, $gift_id); 
            }
        }
    }

    public function postRequest($url, $data) {
        $client = new Client();
        $res = $client->get($url, ['json' => $data]);
        // \Log::info($res->getStatusCode());
        // // "200"
        // \Log::info($res->getHeader('content-type'));
        // // 'application/json; charset=utf8'
        // \Log::info($res->getBody());
        // // {"type":"User"...'
        return $res->getBody();
    }
}
