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
        $user->givePermissionTo('posts.access');
        $user->givePermissionTo('posts.read');
        $user->givePermissionTo('posts.write');
        $user->givePermissionTo('tags.access');
        $user->givePermissionTo('tags.read');
        $user->givePermissionTo('tags.write');
        $user->givePermissionTo('users.access');
        $user->givePermissionTo('users.read');
        $user->givePermissionTo('users.write');

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('proteco123'),
        ]);
        $user->givePermissionTo('categories.access');
        $user->givePermissionTo('categories.read');
        $user->givePermissionTo('categories.write');
        $user->givePermissionTo('users.access');


        Category::factory(20)->create();
        Post::factory(100)->create();
        Tag::factory(20)->create();
    }
}