<?php

namespace Database\Seeders;

use App\Models\TrainingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TrainingType::truncate();
      TrainingType::create(['name' => 'local']);
      TrainingType::create(['name' => 'foreign']);
    }
}
