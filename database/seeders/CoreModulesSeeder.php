<?php

namespace Database\Seeders;

use App\Models\CoreModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoreModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        CoreModule::create([
            'name' => 'Training',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392718.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
        CoreModule::create([
            'name' => 'Institute',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392747.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
        CoreModule::create([
            'name' => 'Settings',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392685.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
        CoreModule::create([
            'name' => 'Trainee',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392702.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
        CoreModule::create([
            'name' => 'Report',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392582.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
        CoreModule::create([
            'name' => 'Events',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392604.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
        CoreModule::create([
            'name' => 'Procurement',
            'link' => 'www.google.com',
            'image' => '/uploads/coremodule/1667392664.png',
            'status' => CoreModule::$statusArrays[0],
        ]);
    }
}
