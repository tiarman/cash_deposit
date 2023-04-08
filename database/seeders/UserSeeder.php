<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
        'name_en' => 'RAST Admin',
        'username' => 'RASTAdmin',
        'phone' => '01797325129',
        'email' => 'admin@rast.com',
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);
      $usertwo = User::create([
        'name_en' => 'Admin 2',
        'username' => 'Admin2',
        'phone' => '01627631392',
        'email' => 'admin@mail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $agentOne = User::create([
        'name_en' => 'Agent1',
        'username' => 'agent1',
        'phone' => '01600000000',
        'email' => 'trainee@mail.com',
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);
      $agentTwo = User::create([
        'name_en' => 'Agent2',
        'username' => 'agent2',
        'phone' => '01860842421',
        'email' => 'agent1@mail.com',
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);
        $subAgentOne = User::create([
            'agent_id' => '4',
            'name_en' => 'sub Agent 1',
            'username' => 'sAgent1',
            'phone' => '01860842422',
            'email' => 'sagent@mail.com',
            'password' => bcrypt('12345600'),
            'status' => User::$statusArrays[1],
        ]);

        $subAgentTwo = User::create([
            'name_en' => 'Sub Agent 2',
            'username' => 'sAgent2',
            'phone' => '01600000100',
            'email' => 'traineee@mail.com',
            'password' => bcrypt('123456000'),
            'status' => User::$statusArrays[1],
        ]);



      $user->assignRole('Super Admin');
      $usertwo->assignRole('Super Admin');
      $agentOne->assignRole('Agent');
      $agentTwo->assignRole('Agent');
      $subAgentOne->assignRole('Sub Agent');
      $subAgentTwo->assignRole('Sub Agent');


    }
}
