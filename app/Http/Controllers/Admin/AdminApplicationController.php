<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleForm;
use App\Models\Permission;
use App\Models\Apply;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use DB;

class AdminApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-applications');
    }

    public function index(): View
    {
        $applications = Apply::paginate(20);

        return view('admin.apply', [
            'applications' => $applications,
        ]);
    }

    public function show($applicationId): View
    {
        $application = Apply::where('id', $applicationId)->first();

        return view('admin.viewapp', [
            'application' => $application,
        ]);
    }

}
