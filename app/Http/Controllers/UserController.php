<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\permission;
class UserController extends Controller
{

    public function __construct(){
        $this->middleware('permission:user-index|user-create|user-edit|
        user-show|user-delete',['only'=>['index']]);//index is function

        $this->middleware('permission:user-create',['only'=>['create','store']]);

        $this->middleware('permission:user-edit',['only'=>['edit','update']]);

        $this->middleware('permission:user-show',['only'=>['show']]);

        $this->middleware('permission:user-delete',['only'=>['destroy']]);
    }
    public function index(){
        $users = User::all();
        $roles = Role::all();
        return view('user.index', ['users'=>$users, 'roles'=>$roles]);
    }
    
    public function show($id){
        $user = User::find($id);
        return view('user.show', ['user'=>$user]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', ['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
    
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

    if (auth()->user()->role_id == 1 || (auth()->user()->role_id == 2 && $user->role_id != 1)) {
        return view('user.edit', ['user' => $user, 'roles' => $roles]);
    } else {
        abort(403, 'You do not have permission to edit this user.');
    }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role_id = $validatedData['role_id'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
