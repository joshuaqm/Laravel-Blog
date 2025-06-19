<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // Run the roles and permissions seeder first
        $this->call(RoleAndPermissionSeeder::class);

        $user = User::factory()->create([
            'name' => 'Joshua M',
            'email' => 'joshuaqm@correo.com',
            'password' => bcrypt('proteco123'),
        ]);
        $user->assignRole('super-admin');

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('proteco123'),
        ]);
        $user->assignRole('admin');

        Category::factory(20)->create();
        Post::factory(100)->create();
        Tag::factory(20)->create();
    }
}