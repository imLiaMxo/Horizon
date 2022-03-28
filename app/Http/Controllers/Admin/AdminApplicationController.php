<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\UserApplied;
use App\Http\Requests\Admin\RoleForm;
use App\Http\Requests\Admin\AssignForm;
use App\Http\Requests\Admin\CompleteForm;
use App\Models\Permission;
use App\Models\Apply;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
        $appUser = User::where('steamid', $application->steamid)->first();

        return view('admin.viewapp', [
            'application' => $application,
            'userData' => $appUser
        ]);
    }

    public function assign(AssignForm $assign): RedirectResponse
    {
        $application = Apply::where('id', $assign->input('identifier'))->update(['assigned_to' => $assign->input('assigner') ? $assign->input('assigner') : NULL, 'current_step' => $assign->input('assigner') ? 1 : NULL]);
        $appUser = User::where('steamid', $application->steamid)->first();
        $adminUser = User::where('steamid', $assign->input('assigner'))->first();

        if($assign->input('assigner'))
        {
            toastr()->success('Successfully assigned application!');
            Notification::send($appUser, new ApplicationAssigned($adminUser->name, 'has been assigned your application!', route('viewapp', ['applicationId' => $application->id])));
        }
        else
        {
            toastr()->danger('Successfully unassigned application!');
        }
        toastr()->success('Successfully (un)assigned application!');
        return redirect()->route('admin.apply.view', $assign->input('identifier'));
    }

    public function complete(CompleteForm $request): RedirectResponse
    {
        $application = Apply::where('id', $request->input('identifier'))->update(['current_step' => $request->input('action') == 'decline' ? 1 : 2, 'reason' => $request->input('reason') ? $request->input('reason') : NULL, 'outcome' => $request->input('action') == 'decline' ? 1 : 2]);
        if($request->input('action') == 'accept')
        {
            User::where('steamid', $request->steamid)->first()->assignRole('new_member');
            toastr()->success('Application has been accepted. Assigned role.');
        }
        else
        {
            toastr()->error('Application has been rejected!');
        }

        return redirect()->route('admin.apply.view', $request->input('identifier'));
    }

}
