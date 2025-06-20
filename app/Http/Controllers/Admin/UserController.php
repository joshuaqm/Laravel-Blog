<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;

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
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_verified_at' => now(),
        ]);

        // Asignar permisos desde los checkboxes
        $permissions = [];

        if ($request->input('permissions.posts.access')) {
            $permissions[] = 'posts.access';
        }
        if ($request->input('permissions.posts.read')) {
            $permissions[] = 'posts.read';
        }
        if ($request->input('permissions.posts.write')) {
            $permissions[] = 'posts.write';
        }

        $user->syncPermissions($permissions); // Reemplaza todos los permisos existentes


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
