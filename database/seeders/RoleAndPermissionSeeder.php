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
        $sections = ['posts', 'categories', 'tags', 'users']; // Agrega más secciones aquí

        foreach ($sections as $section) {
            Permission::firstOrCreate(['name' => "{$section}.access"]);
            Permission::firstOrCreate(['name' => "{$section}.read"]);
            Permission::firstOrCreate(['name' => "{$section}.write"]);
        }
   }
}