<?php

namespace Database\Seeders;

use App\Models\SubComponent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      SubComponent::truncate();
      SubComponent::create([
        'component_id' => 1,
        'name' => 'Pay of Officer',
        'created_by' => 1,
      ]);
      SubComponent::create([
        'component_id' => 2,
        'name' => 'Pay of Establishment',
        'created_by' => 1,
      ]);
      SubComponent::create([
        'component_id' => 3,
        'name' => 'Office Allowances',
        'created_by' => 1,
      ]);
      SubComponent::create([
        'component_id' => 3,
        'name' => 'Home Allowances',
        'created_by' => 1,
      ]);
      SubComponent::create([
        'component_id' => 4,
        'name' => 'Supplies and Services',
        'created_by' => 1,
      ]);
      SubComponent::create([
        'component_id' => 2,
        'name' => 'Smart Phone',
        'created_by' => 1,
      ]);
    }
}
