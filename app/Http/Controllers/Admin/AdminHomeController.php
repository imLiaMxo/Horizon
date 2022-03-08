<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Payment;
use App\Models\User;
use DB;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-management');
    }

    public function clamp($input, $min, $max)
    {
        return max($min, min($input, $max));
    }

    public function index()
    {
        $goalProgress = Cache::remember('donate.goal', 1, function () {
            if (!(bool) config('horizon.configs.monthly_goal_enabled', false)) {
                return null;
            }

            $goal = (float) config('horizon.configs.monthly_goal');
            $cur = (float) Payment::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('amount');

            return round($this->clamp(($cur / $goal) * 100, 0, 100));
        });

        $goal = (float) config('horizon.configs.monthly_goal');
        $cur = (float) Payment::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->sum('amount');

        $usersCount = User::count();
        $serversCount = DB::table('servers')->count();

        return view('admin.index', ['usersCount' => $usersCount, 'serversCount' => $serversCount, 'donateGoal' => $goal, 'donateCur' => $cur, 'goalProgress' => $goalProgress]);
    }
}
