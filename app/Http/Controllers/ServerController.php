<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class ServerController extends Controller
{
    public function index()
    {
        $serversList = DB::table("servers")->get();
        $responseArray = array();
        $battlemetricsURL = "https://api.battlemetrics.com/servers/";
        $headers = [
            'Authorization' => env('BM_SECRET_KEY')
        ];

        foreach($serversList as $server){
            $battlemetricsURLIndividual = $battlemetricsURL . $server->bm_id;
            $response = Http::withHeaders($headers)->get($battlemetricsURLIndividual);

            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody(), true);

            array_push($responseArray, $responseBody);
        }

        return view('servers', ['response' => $responseArray]);
    }
}
