<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|string|max:255',
        ]);

        Permission::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Permiso creado correctamente.',
            'text' => 'El permiso ha sido creado exitosamente.',
        ]);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . '|string|max:255',
        ]);

        $permission->update([
            'name' => $request->input('name'),
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Permiso actualizado correctamente.',
            'text' => 'El permiso ha sido actualizado exitosamente.',
        ]);

        return redirect()->route('admin.permissions.edit', $permission->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Permiso eliminado correctamente.',
            'text' => 'El permiso ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.permissions.index');
    }
}
