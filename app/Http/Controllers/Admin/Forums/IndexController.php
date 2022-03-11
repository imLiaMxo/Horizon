<?php

namespace App\Http\Controllers\Admin\Forums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-forums');
    }

    public function index()
    {

        return view('admin.forums.index');
    }
}
