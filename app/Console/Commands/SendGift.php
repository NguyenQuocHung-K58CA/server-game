<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\GiftModel;
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
        for ($i=0; $i < $this->numberLoop; $i++){
            $user_id = Redis::rpop('giftlist');
            if (!$user_id) break;

            $gift_id = Redis::hget("gifts", $user_id);
            $data = array('user_id' => $user_id, 'gift_id' => $gift_id);
            $response = $this->postRequest(env('SERVER_GAME'), $data);

            if (199 < $response->getStatusCode() && $response->getStatusCode() < 300) {

                \Log::info(" Updated for user has id = ".$user_id." ".json_decode($response->getBody() ));
                if (json_decode($response->getBody() )=="ok") {
                    try {                        
                        GiftModel::updateByUserId($user_id, ['status'=>1]);
                    }
                    catch (\Exception $e) {
                        \Log::info("Update Failed at App\Console\Commands\SendGift.php handle".$e);
                    }
                }
            }
            else {
                Redis::lpush('giftlist', $user_id);
            }
        }
        // check giftlist empty
        if (!Redis::lindex('giftlist', 0)) {
            $this->checkSendGift();
        }
        \Log::info(" Run job:sendgift successfull.");
    }

    public function postRequest($url, $data) {
        $client = new Client();
        $response = $client->get($url, ['json' => $data]);
        return $response;
    }

    public function checkSendGift() {
        try {
            \Log::info("Run check Send");            
            $unSendGifts = GiftModel::where('status', '=', 0)->get();
            foreach ($unSendGifts as $gift) {
                Redis::hsetnx('gifts', $gift->user_id, $gift->gift_id);
                Redis::lpush('giftlist', $gift->user_id);
            }
        }
        catch (\Exception $e) {            
            \Log::info("Update Failed at App\Console\Commands\SendGift.php checkSendGift ".$e);
        }
    }
}
