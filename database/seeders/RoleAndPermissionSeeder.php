<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permisos para Posts (coinciden con los nombres de tus checkboxes)
        Permission::firstOrCreate(['name' => 'posts.access']);
        Permission::firstOrCreate(['name' => 'posts.read']);
        Permission::firstOrCreate(['name' => 'posts.write']);

        // Rol Super Admin (todos los permisos)
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $roleSuperAdmin->givePermissionTo([
            'posts.access',
            'posts.read',
            'posts.write'
        ]);

        // Rol Admin (solo lectura, por ejemplo)
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->givePermissionTo('posts.read');
    }
}
