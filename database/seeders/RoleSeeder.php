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
    $admin = Role::create([
      'name' => 'Admin'
    ]);
    $admin = Role::create([
      'name' => 'Pmu'
    ]);
    $client = Role::create([
      'name' => 'Client'
    ]);
    $trainee = Role::create([
      'name' => 'Trainee'
    ]);
    $instituteHead = Role::create([
      'name' => 'Institute Head'
    ]);

    $student = Role::create([
      'name' => 'Student'
    ]);
    $teacher = Role::create([
      'name' => 'Teacher'
    ]);
    $moi = Role::create([
      'name' => 'Moi'
    ]);
    $bmet = Role::create([
      'name' => 'Bmet'
    ]);
    $tmed = Role::create([
      'name' => 'Tmed'
    ]);
    $industry = Role::create([
      'name' => 'Industry'
    ]);


    Role::create(['name' => 'Batch Creator']);

    Role::create(['name' => 'Batch Approver']);
    Role::create(['name' => 'Officer']);
    Role::create(['name' => 'Staff']);
    Role::create(['name' => 'Mentor']);

    $superAdmin->givePermissionTo(Permission::all());
    $superAdmin->revokePermissionTo([
      'List Of Institute User',
      'Create Institute User',
      'Manage Institute User',
      'Delete Institute User',
      'View Institute User',
    ]);
    $admin->givePermissionTo(Permission::all());
    $instituteHead->givePermissionTo([
      'List Of Voucher',
      'Create Voucher',
      'Manage Voucher',
      'Delete Voucher',
      'View Voucher',
      'List Of Training',
      'Create Training',
      'Manage Training',
      'Delete Training',
      'View Training',
      'List Of Institute User',
      'Create Institute User',
      'Manage Institute User',
      'Delete Institute User',
      'View Institute User',
    ]);
  }
}
