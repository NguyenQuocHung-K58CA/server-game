<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GiftDetail;
use Response;
use Redis;

class GiftDetailsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if ($check) {
            $this->addReceiveGift($data);
            $data['send_gift'] = 1;
            GiftDetail::create($data);
        }

        return back()->with("status", "Gift sent successful!");
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
