<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('permission.index' , ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $role_id = $request->input('role_id');
        $routes = $request->except('_token', 'role_id');
        $data = [];

        foreach ($routes as $route) {
            $data[] = [
                'role_id' => $role_id,
                'route_name' => $route,
            ];
        }

        DB::beginTransaction();
        try {
            Permission::where('role_id', $role_id)->delete();
            Permission::insert($data);
            
            DB::commit();

            return redirect()->route('permission.index')->with('success', 'Permissions were saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('permission.index')->with('error', 'Permissions could not be saved.')->withErrors(['exception' => $e->getMessage()]);
        }
    }
}
