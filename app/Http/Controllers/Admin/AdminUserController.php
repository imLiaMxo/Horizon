<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UpdateUserForm;
use DB;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-management');
    }

    public function index()
    {
        $users = User::with('displayRole')->orderByDesc('created_at')->paginate(30);
        $roles = Role::withCount(['permissions', 'users'])->orderByDesc('precedence')->get();
        return view('admin.users', [
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->input('userid'));
        $roles = $request->input('roles');
        $user->syncRoles($roles);

        return redirect()->route('admin.users');
    }
}
