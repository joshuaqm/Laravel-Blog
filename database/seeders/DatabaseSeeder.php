<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Lection;
use App\Models\Post;
use App\Models\Section;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');
        // Run the roles and permissions seeder first
        // $this->call(RoleAndPermissionSeeder::class);

        $user = User::factory()->create([
            'name' => 'Joshua M',
            'email' => 'joshuaqm@correo.com',
            'password' => bcrypt('proteco123'),
        ]);
        // $user->givePermissionTo('posts.read');
        // $user->givePermissionTo('posts.write');
        // $user->givePermissionTo('tags.read');
        // $user->givePermissionTo('tags.write');
        // $user->givePermissionTo('users.read');
        // $user->givePermissionTo('users.write');
        // $user->givePermissionTo('categories.read');
        // $user->givePermissionTo('categories.write');

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('proteco123'),
        ]);
        // $user->givePermissionTo('categories.read');
        // $user->givePermissionTo('categories.write');
        // $user->givePermissionTo('posts.read');
        // $user->givePermissionTo('posts.write');

        User::factory(10)->create()->each(function ($user) {
            $user->profile()->save(Profile::factory()->make());
        });

        Category::factory(20)->create();
        Post::factory(100)->create()->each(function ($post) {
            $post->images()->create([
                'path' => 'images/posts/' . $post->id
            ]);
        });


        Tag::factory(20)->create();
        Course::factory(20)->create();
        Section::factory(20)->create();
        Lection::factory(20)->create();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}