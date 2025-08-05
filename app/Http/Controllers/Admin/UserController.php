<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $data['password'] = bcrypt($data['password']);

        // Crear usuario
        $user = User::create($data);

        // Asignar roles desde los checkboxes
        if (isset($data['roles'])) {
            $user->roles()->attach($data['roles']);
        }
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡El usuario ha sido creado!',
            'text' => 'Ahora puedes gestionar este usuario desde el panel de administración.',
        ]);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();        
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update($data);
        $user->roles()->sync($request->input('roles', []));

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡El usuario ha sido actualizado!',
            'text' => 'Ahora puedes gestionar este usuario desde el panel de administración.',
        ]);
        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth('web')->id()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡No puedes eliminarte a ti mismo!',
                'text' => 'Por favor, contacta al administrador del sistema si necesitas ayuda.',
            ]);
            return redirect()->route('admin.users.index');
        }

        $user->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡El usuario ha sido eliminado!',
            'text' => 'Ahora puedes gestionar los usuarios desde el panel de administración.',
        ]);
        return redirect()->route('admin.users.index');
    }
}
