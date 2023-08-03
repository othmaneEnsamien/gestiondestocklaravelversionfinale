<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function managePermissions()
    {
        $permissions = Permission::paginate(4);

        return view('admin.permissions.permissions', compact('permissions'));
    }

    public function storePermission(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        $permission = Permission::create([
            'name' => $validatedData['name'],
            'guard_name' => 'web',
        ]);

        return redirect()->back()->with('success', 'Permission added successfully.');
    }

    public function editPermission(Permission $permission)
    {
        return view('admin.permissions.modifierpermission', compact('permission'));
    }

    public function updatePermission(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->name = $validatedData['name'];
        $permission->save();

        return redirect()->route('permissions.manage')->with('success', 'Permission updated successfully.');
    }

    public function destroyPermission(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.manage')->with('success', 'Permission deleted successfully.');
    }
}
