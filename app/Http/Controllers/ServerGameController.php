<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Redis;
use App\Gift;
use App\GiftDetail;

class ServerGameController extends Controller
{
    public function api(Request $request)
    {
        // \Log::info("request api : " . $request->all());
        // \Log::info("Resquest api : ".Response::json($request->all()) );
        return response()->json('ok');
    }

    public function getGifts()
    {
        // \Log::info("request api : " . $request->all());
        // \Log::info("Resquest api : ".Response::json($request->all()) );
        return Response::json(Gift::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->get_info_send($request, ['user_id', 'gift_id']);
        $check = $this->addSendedGift($data);
        $message = "Gift sent.";
        if ($check) {
            if (!$this->addReceiveGift($data)) {
                $message = "Gift received.";
            }
            $data['send_gift'] = 1;
            GiftDetail::create($data);
        }

        return Response::json(["message" => $message]);
    }

    public function addSendedGift($data){
        return Redis::hsetnx('sendedGifts', $data['user_id'], $data['gift_id']);
    }

    public function addReceiveGift($data) {        
        return Redis::hsetnx('receiveGifts', $data['user_id'], $data['gift_id']); 
    }

    public function get_info_send(Request $request, $keys = ['*']) {
        $data = $request->only($keys);
        return $data;
    }
}
