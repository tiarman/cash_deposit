<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $superAdmin = Role::create([
      'name' => 'Super Admin'
    ]);
      $agent = Role::create([
          'name' => 'Agent'
      ]);
      $subagent = Role::create([
          'name' => 'Sub Agent'
      ]);
      $payment = Role::create([
          'name' => 'Payment'
      ]);




    $superAdmin->givePermissionTo(Permission::all());
    // $agent->givePermissionTo(Permission::all());
    // $subagent->givePermissionTo(Permission::all());

  }
}
