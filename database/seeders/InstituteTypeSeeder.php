<?php

namespace Database\Seeders;

use App\Models\InstituteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      InstituteType::truncate();
      InstituteType::create(['name'=>'Training Provider']);
      foreach (['Polytechnic','TSC','IHT','IMT','MATS','NI','TTC','Private Short Course','RTO', 'Enterprise', 'MoI'] as $name){
        InstituteType::create(['name'=>$name]);
      }
    }
}
