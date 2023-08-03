<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{



    public function showUsersRolesAndPermissions()
    {
        // Récupérer tous les utilisateurs avec leurs rôles et permissions
        $users = User::with('roles.permissions')->get();
        $roles = Role::all();

        return view('admin.users.users', compact('users', 'roles'));
    }


    // public function create(array $data)
    // {
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);

    //     $roleId = request()->input('role'); // Récupérer l'ID du premier rôle sélectionné depuis la requête
    //     $role = Role::find($roleId); // Récupérer le rôle par son ID
    //     $user->assignRole($role);
    //     return $user;
    // }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.users', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password  =
            Hash::make($request->input('password'));
        $user->save();

        $roleId = $request->input('role'); // Récupérer l'ID du rôle sélectionné depuis la requête
        $role = Role::find($roleId); // Récupérer le rôle par son ID
        $user->assignRole($role);

        Mail::to($user->email)->send(new UserRegisteredMail($user));
        return redirect()->back()->with('success', 'L\'utilisateur a été enregistré avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.roles.permissions')
            ->with('success', 'User deleted successfully');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        $roleId = $request->input('role');
        $role = Role::find($roleId);

        $user->roles()->sync([$role->id]);
        Mail::to($user->email)->send(new UserRegisteredMail($user));

        return redirect()->back()->with('success', 'L\'utilisateur a été modifié avec succès.');
    }
}
