<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Admin\ServerForm;
use App\Models\Server;
use Illuminate\Http\RedirectResponse;

class AdminServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-servers');
    }

    public function index()
    {
        $servers = Server::all();
        $responseArray = array();
        $battlemetricsURL = "https://api.battlemetrics.com/servers/";
        $headers = [
            'Authorization' => env('BM_SECRET_KEY')
        ];

        foreach($servers as $server){
            $battlemetricsURLIndividual = $battlemetricsURL . $server->bm_id;
            $response = Http::withHeaders($headers)->get($battlemetricsURLIndividual);

            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody(), true);

            array_push($responseArray, $responseBody);
        }

        return view('admin.servers', [
            'servers' => $servers,
            'details' => $responseArray
        ]);
    }

    public function store(ServerForm $request): RedirectResponse
    {
        Server::create($request->validated());

        toastr()->success('Successfully created new server!');
        return redirect()->route('admin.servers');
    }
    
    public function destroy($server): RedirectResponse
    {
        Server::where('bm_id', $server)->delete();

        toastr()->success('Successfully deleted server!');
        return redirect()->route('admin.servers');
    }
}
