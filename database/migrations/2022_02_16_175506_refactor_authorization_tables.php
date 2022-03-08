<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class RefactorAuthorizationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Put all old data in memory
        $permissions = DB::table('permissions')->get()->keyBy('id');
        $roles = DB::table('roles')->get()->keyBy('id');
        $users = DB::table('users')->get()->keyBy('id');
        $oldPermissionsArray = $this->getOldPermissionsArray();

        $this->refactorPermissionsTable();

        // Fixes unique constraint error
        foreach ($roles->groupBy('name') as $name => $group) {
            if (count($group) <= 1) continue; // There's no issue

            foreach($group as $i => $role) {
                if ($i === 0) continue; // We can keep the first role as original

                DB::table('roles')
                    ->where('id', $role->id)
                    ->update(['name' => $i.$name]);
            }
        }

        Schema::table('roles', function (Blueprint $table) {
            $table->string('guard_name')
                ->default('web')
                ->after('name');

            $table->integer('precedence')
                ->default(0)
                ->after('color');

            $table->unique(['name', 'guard_name']);
        });

        Role::whereId(2)
            ->update([
                'precedence' => 100,
            ]);

        $this->createPivotTables();

        foreach ($oldPermissionsArray as $permission) {
            Permission::create([
                'name' => $permission['reference'],
                'display_name' => $permission['display'],
                'description' => $permission['description'],
            ]);
        }

        foreach ($roles as $role) {
            // retrieve permission name first
            $rolePermissions = $permissions->where('role_id', $role->id)->map(function (object $permission) use ($oldPermissionsArray) {
                return $oldPermissionsArray[$permission->permission]['reference'];
            })->values();

            $roleModel = Role::whereId($role->id)->first();
            if (!$roleModel) continue;

            $roleModel->givePermissionTo($rolePermissions);
        }

        foreach ($users as $user) {
            $oldRoleId = $user->role_id;

            $oldRole = $roles->get($oldRoleId);
            if (!$oldRole) continue;

            $userModel = User::whereId($user->id)->first();
            if (!$userModel) continue;

            $userModel->assignRole($oldRole->name);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
    }

    private function createPivotTables()
    {
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->primary(['permission_id', 'model_id', 'model_type'], 'model_has_permissions_permission_model_type_primary');
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['role_id', 'model_id', 'model_type'], 'model_has_roles_role_model_type_primary');
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });
    }

    private function refactorPermissionsTable()
    {
        DB::table('permissions')
            ->delete();

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['permission', 'role_id']);

            $table->string('name')->after('id');
            $table->string('guard_name')->after('name');

            $table->string('display_name')->after('guard_name');
            $table->string('description')->after('display_name');

            $table->unique(['name', 'guard_name']);
        });
    }

    private function getOldPermissionsArray(): array
    {
        return [
            [
                'reference' => 'view-management',
                'display' => 'View Management',
                'description' => 'Has permission to access the management page'
            ],
            [
                'reference' => 'manage-settings',
                'display' => 'Manage Settings',
                'description' => 'Has permission to manage the application settings'
            ],
            [
                'reference' => 'manage-servers',
                'display' => 'Manage Servers',
                'description' => 'Has permission to manage servers'
            ],
            [
                'reference' => 'manage-forums',
                'display' => 'Manage Forums',
                'description' => 'Has permission to manage forums'
            ],
            [
                'reference' => 'manage-applications',
                'display' => 'Manage Applications',
                'description' => 'Has permission to manage applications'
            ],
            [
                'reference' => 'manage-roles',
                'display' => 'Manage Roles',
                'description' => 'Has permission to manage roles'
            ],
            [
                'reference' => 'manage-settomgs',
                'display' => 'Manage Settings',
                'description' => 'Has permission to manage core application configurations'
            ],
        ];
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
