<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::all();
        return Inertia::render('Permission/Permissions', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Permission/AddPermission', [
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

        Permission::create($request->all());

        return redirect()->back()->with('status', 'Permission added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $permission = Permission::find($id);
        return Inertia::render('Permission/Permission', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        return redirect()->back()->with('success', 'Permission has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permissions')->with('status', 'Permission deleted!');
    }
}
