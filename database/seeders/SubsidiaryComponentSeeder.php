<?php

namespace Database\Seeders;

use App\Models\SubComponent;
use App\Models\SubsidiaryComponent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubsidiaryComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      SubsidiaryComponent::truncate();
      SubsidiaryComponent::create([
        'sub_component_id' => 1,
        'component_id' => 1,
        'name' => 'Pay of Officer',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 2,
        'component_id' => 2,
        'name' => 'Pay of Establishment',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'House Rent',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Recreation Leave',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Festival',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Medical',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Entertainment',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Additional Charges',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Tiffin',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Conveyance',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Telephone',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Deputation Charges',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Education Aid',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Teacher Incentive for general subjects',
        'code' => '2.2',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Teacher Incentive for Technical subjects',
        'code' => '2.2',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Manpower (contractual hiring of Teacher) for Polytechnic',
        'code' => '1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 3,
        'component_id' => 3,
        'name' => 'Honorarium for Curriculum Expert Committees',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Field Visit & Relevant Cost',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'TA/DA',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Tax/Vat',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Phones, fax internet, Modem etc.',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Gas',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Fuel,oil and lubricant',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Bank Charges',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Commission/Interest',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Development and Reproduction of Technical Books',
        'code' => '3.2',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Trg. Materials Development/Reproduction',
        'code' => '3.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Office Utilities/Office Supplies',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Action Research/Unspecified Studies',
        'code' => '3.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Books and Journals',
        'code' => '4.1.1',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Communication and Awareness Materials',
        'code' => '4.1.2',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Reproduction of Communication and Awareness Materials',
        'code' => '4.1.2',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Institution and Dissemination',
        'code' => '4.1.2',
        'created_by' => 1,
      ]);
      SubsidiaryComponent::create([
        'sub_component_id' => 4,
        'component_id' => 4,
        'name' => 'Mass Campaign and Rally',
        'code' => '4.1.2',
        'created_by' => 1,
      ]);
    }
}
