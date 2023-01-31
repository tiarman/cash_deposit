<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Component::truncate();
      Component::create([
        'name' => 'Pay of Officer',
        'created_by' => 1,
      ]);
      Component::create([
        'name' => 'Pay of Establishment',
        'created_by' => 1,
      ]);
      Component::create([
        'name' => 'Allowances',
        'created_by' => 1,
      ]);
      Component::create([
        'name' => 'Supplies and Services',
        'created_by' => 1,
      ]);
    }
}
