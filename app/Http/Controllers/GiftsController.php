<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\GiftModel;
use Redis;
use Auth;

class GiftsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getUserId(){
        return Auth::user()->id;
    }

    public function index()
    {
        $gift = GiftModel::where("user_id", $this->getUserId())->first();
        return view('gifts.index', ["gift"=>$gift]);
    }

    public function store(Request $request)
    {
        $gift_id = $request->input('gift_id');
        $user_id = $this->getUserId();

        $checkSend = Redis::hsetnx('gifts', $user_id, $gift_id);
        if ($checkSend) {
            Redis::lpush("giftlist", $user_id);
        }
        
        GiftModel::firstOrCreate(['user_id'=>$user_id, 'gift_id'=>$gift_id]);

        return back();//->with("status", "Gift sent successful!");
    }

}
