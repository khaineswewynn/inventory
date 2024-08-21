<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function showRolesPermissions()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::select('route_name')->distinct()->get();

        return view('roles_permissions.assign-permissions', compact('roles', 'permissions'));
    }

    public function updateRolePermissions(Request $request)
    {
        $rolesData = $request->input('roles', []);

        foreach ($rolesData as $roleId => $permissions) {
            $role = Role::findOrFail($roleId);
            $role->permissions()->delete();

            foreach ($permissions as $permission) {
                Permission::create([
                    'role_id' => $roleId,
                    'route_name' => $permission,
                ]);
            }
        }

        return redirect()->route('assign-permissions')->with('success', 'Permissions updated successfully.');
    }

    public function showAssignRolesToUsers()
    {
        $users = User::all();
        $roles = Role::all();

        return view('roles_permissions.assign-roles', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request)
    {
        $usersData = $request->input('roles', []);

        foreach ($usersData as $userId => $roleId) {
            $user = User::findOrFail($userId);
            $user->role_id = $roleId;
            $user->save();
        }

        return redirect()->route('assign-roles')->with('success', 'Roles updated successfully.');
    }
}
