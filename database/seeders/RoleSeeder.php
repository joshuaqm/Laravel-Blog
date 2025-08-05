<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin' => [
                'access dashboard',
                'manage categories',
                'manage posts',
                'manage tags',
                'manage users',
                'manage permissions',
                'manage roles'
            ],
            'blogger' => [
                'access dashboard',
                'manage posts',
                'manage categories',
            ],
        ];

        foreach ($roles as $name => $permissions) {
            $role = Role::create(['name' => $name]);
            $role->syncPermissions($permissions);
        }
    }
}
