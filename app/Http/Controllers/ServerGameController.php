<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Gift;

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
}
