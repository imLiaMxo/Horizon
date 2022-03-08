<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Apply;
use App\Models\User;
use App\Notifications\UserApplied;
use DB;

class ApplicationController extends Controller
{
    public function index()
    {
        $appValid = Apply::where('steamid', '=', auth()->user()->steamid)->first();
        if ($appValid === NULL) {
            return view('application');
        } else {
            return view('viewapp', [
                'application' => $appValid,
            ]);
        }
    }

    public function store(Request $request)
    {
        $application = new Apply;
        $application->username = $request->username;
        $application->steamid = $request->steamid;
        $application->country = $request->country;
        $application->age = $request->age;

        $application->save();
        
        $users = User::all();
        $allowedUsers = array();
        foreach($users as $user)
        {
            if($user->hasPermissionTo('manage-applications'))
            {
                array_push($allowedUsers, $user);
            }
        }

        Notification::send($allowedUsers, new UserApplied($application->username, 'has sent in their application', route('admin.apply')));
        return redirect()->route('home');
    }

    public function check()
    {
        $steamId = auth()->user()->steamid;
        $steamUrl = "https://steamcommunity.com/profiles/" . $steamId . "?xml=1";
        $steamXmlFile = file_get_contents($steamUrl);
        $steamXmlData = simplexml_load_string($steamXmlFile);
        $steamXmlJson = json_encode($steamXmlData);
        $steamXmlArr = json_decode($steamXmlJson, true);
        
        return $steamXmlArr["vacBanned"] ? false : true;
    }
}
