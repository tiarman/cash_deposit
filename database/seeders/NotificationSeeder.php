<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Notification::truncate();
    $faker = Factory::create();
    $user = collect(User::pluck('id')->toArray());

    foreach (range(0, 3000) as $i) {
      Notification::create([
        'user_id' => $user->random(),
        'type' => collect(Notification::$types)->random(),
        'title' => $faker->sentence(rand(3,6)),
        'message' => $faker->paragraph(rand(2,5))
      ]);
    }
  }
}
