<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleForm;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-roles');
    }

    public function index(): View
    {
        $roles = Role::withCount(['permissions', 'users'])->orderByDesc('precedence')->get();
        $permissions = Permission::all();

        return view('admin.roles', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(RoleForm $request): RedirectResponse
    {
        /** @var Role $role */
        $role = Role::create($request->validated());

        $role->givePermissionTo(
            $request->input('permissions')
        );
        toastr()->success('Successfully create new role!');
        return redirect()->route('admin.roles');
    }

    public function update(RoleForm $request, Role $role): RedirectResponse
    {
        //$this->authorize('update', $role);

        $role->update($request->validated());

        $role->syncPermissions(
            $request->input('permissions')
        );

        toastr()->success('Successfully updated role!');
        return redirect()->route('admin.roles');
    }

    public function destroy(Role $role): RedirectResponse
    {
        //$this->authorize('delete', $role);

        $role->delete();

        toastr()->warning('You have removed a role.');
        return redirect()->route('admin.roles');
    }

}
