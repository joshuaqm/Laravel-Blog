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
        $roleSuperAdmin = Role::firstOrCreate([
            'name' => 'super-admin'
        ]);
        $roleAdmin = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        Permission::firstOrCreate([
            'name' => 'ver post'
        ]);

        Permission::firstOrCreate([
            'name' => 'crear post'
        ]);

        Permission::firstOrCreate([
            'name' => 'editar post'
        ]);

        $roleSuperAdmin->givePermissionTo('ver post');
        $roleSuperAdmin->givePermissionTo('crear post');
        $roleSuperAdmin->givePermissionTo('editar post');
    }
}
