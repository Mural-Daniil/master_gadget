<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::all();
        return Inertia::render('Role/Roles', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();

        return Inertia::render('Role/AddRole', [
            'allPermissions' => $permissions
        ]); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);
        if($request->has('permissions') && count($request->get('permissions')) > 0) {
        $role->syncPermissions($request->get('permissions'));
        }

        return redirect()->back()->with('status', 'Role added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $role = Role::find($id);
        return Inertia::render('Role/Role', [
            'role' => $role,
            'allPermissions' => Permission::all(),
            'rolePermissions' => $role->getAllPermissions()->pluck('id'),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update(['name' => $request->name]);

        if($request->has('permissions') && count($request->get('permissions')) > 0) {
        $role->syncPermissions($request->get('permissions'));
        }

        return redirect()->back()->with('success', 'Role has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Role::find($id)->delete();
        return redirect()->route('roles')->with('status', 'Role deleted!');
    }
}
