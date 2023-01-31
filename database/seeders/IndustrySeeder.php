<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industry1 = User::create([
            'name_en' => 'Industry 1',
            'name_bn' => 'ভোলা টেকনিক্যাল',
            'website' => 'https://www.google.com/',
            'phone' => '01860842407',
            'email' => 'in@gmail.com',
            'username' => 'industry1',
            'email_verified_at' => now(),
            'password' => bcrypt('12345600'),
            'status' => User::$statusArrays[1],
        ]);
        $industry1->assignRole('Industry');
    }
}
