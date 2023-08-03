<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(4);
        $permissions = Permission::all();
        return view('admin.roles.roles', compact('roles', 'permissions'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::firstOrCreate(['name' => $validatedData['name']]);

        $permissions = [];

        if (isset($validatedData['permissions'])) {
            $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();
        }

        $role->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Permissions added successfully.');
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.modifierrole', compact('role', 'permissions'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $validatedData['name'];
        $role->save();

        if (isset($validatedData['permissions'])) {
            $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();

            // Supprimer toutes les permissions existantes du rôle
            $role->permissions()->detach();

            // Ajouter les nouvelles permissions au rôle
            $role->permissions()->attach($permissions);
        }


        return redirect()->back()->with('success', 'Rôle mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'Rôle supprimé avec succès.');
    }
}
