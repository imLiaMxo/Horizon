<?php

namespace App\Http\Composers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use DB;

class AppComposer
{
    public function __construct()
    {
        $this->configdata = DB::table('configurations');
    }
    public function compose(View $view)
    {

        $view->with('configs', config('horizon.configs'));

        $view->with('currency', config('horizon.currencies')[config('horizon.configs.store_currency', 'USD')]);
    }
}
