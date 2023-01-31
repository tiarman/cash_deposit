<?php

namespace Database\Seeders;

use App\Models\BackgroundImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

      $this->call(PermissionSeeder::class);
      $this->call(RoleSeeder::class);
      $this->call(UserSeeder::class);

      BackgroundImage::create([
        'image' => '/uploads/background/1667822071.png',
        'status' => BackgroundImage::$statusArray[0]
      ]);

    }
}
