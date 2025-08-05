<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'access dashboard',
            'manage categories',
            'manage posts',
            'manage tags',
            'manage users',
            'manage permissions',
            'manage roles'
        ];

        foreach ($permissions as $permission){
            Permission::create([
                'name'=> $permission,
            ]);
        }
    }
}
