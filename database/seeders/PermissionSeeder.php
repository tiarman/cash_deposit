<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {

//        Permission
    Permission::create([
      'type' => 'Permission',
      'name' => 'Manage Permission'
    ]);
//      User
    Permission::create([
      'type' => 'User',
      'name' => 'List Of User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'Create User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'Manage User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'Delete User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'View User'
    ]);

//      Role
    Permission::create([
      'type' => 'Role',
      'name' => 'List Of Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'Create Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'Manage Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'Delete Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'View Role'
    ]);

    //      Event
    Permission::create([
      'type' => 'Event',
      'name' => 'List Of Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'Create Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'Manage Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'Delete Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'View Event'
    ]);

//      Division
    Permission::create([
      'type' => 'Division',
      'name' => 'List Of Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'Create Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'Manage Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'Delete Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'View Division'
    ]);


//      District
    Permission::create([
      'type' => 'District',
      'name' => 'List Of District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'Create District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'Manage District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'Delete District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'View District'
    ]);


//      Upazila
    Permission::create([
      'type' => 'Upazila',
      'name' => 'List Of Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'Create Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'Manage Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'Delete Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'View Upazila'
    ]);

    //      Info
    Permission::create([
      'type' => 'Info',
      'name' => 'List Of Info'
    ]);
    Permission::create([
      'type' => 'Info',
      'name' => 'Create Info'
    ]);
    Permission::create([
      'type' => 'Info',
      'name' => 'Manage Info'
    ]);
    Permission::create([
      'type' => 'Info',
      'name' => 'Delete Info'
    ]);
    Permission::create([
      'type' => 'Info',
      'name' => 'View Info'
    ]);

    //      Education
    Permission::create([
      'type' => 'Education',
      'name' => 'List Of Education'
    ]);
    Permission::create([
      'type' => 'Education',
      'name' => 'Create Education'
    ]);
    Permission::create([
      'type' => 'Education',
      'name' => 'Manage Education'
    ]);

    Permission::create([
      'type' => 'Education',
      'name' => 'Delete Education'
    ]);
    Permission::create([
      'type' => 'Education',
      'name' => 'View Education'
    ]);


    //      Certificate
    Permission::create([
      'type' => 'Certificate',
      'name' => 'List Of Certificate'
    ]);
    Permission::create([
      'type' => 'Certificate',
      'name' => 'Create Certificate'
    ]);
    Permission::create([
      'type' => 'Certificate',
      'name' => 'Manage Certificate'
    ]);

    Permission::create([
      'type' => 'Certificate',
      'name' => 'Delete Certificate'
    ]);
    Permission::create([
      'type' => 'Certificate',
      'name' => 'View Certificate'
    ]);

    //      Job Experience
    Permission::create([
      'type' => 'Job Experience',
      'name' => 'List Of Job Experience'
    ]);
    Permission::create([
      'type' => 'Job Experience',
      'name' => 'Create Job Experience'
    ]);
    Permission::create([
      'type' => 'Job Experience',
      'name' => 'Manage Job Experience'
    ]);

    Permission::create([
      'type' => 'Job Experience',
      'name' => 'Delete Job Experience'
    ]);
    Permission::create([
      'type' => 'Job Experience',
      'name' => 'View Job Experience'
    ]);
    //      Component
    Permission::create([
      'type' => 'Component',
      'name' => 'List Of Component'
    ]);
    Permission::create([
      'type' => 'Component',
      'name' => 'Create Component'
    ]);
    Permission::create([
      'type' => 'Component',
      'name' => 'Manage Component'
    ]);
    Permission::create([
      'type' => 'Component',
      'name' => 'Delete Component'
    ]);
    Permission::create([
      'type' => 'Component',
      'name' => 'View Component'
    ]);

    //      Sub Component
    Permission::create([
      'type' => 'Sub Component',
      'name' => 'List Of Sub Component'
    ]);
    Permission::create([
      'type' => 'Sub Component',
      'name' => 'Create Sub Component'
    ]);
    Permission::create([
      'type' => 'Sub Component',
      'name' => 'Manage Sub Component'
    ]);
    Permission::create([
      'type' => 'Sub Component',
      'name' => 'Delete Sub Component'
    ]);
    Permission::create([
      'type' => 'Sub Component',
      'name' => 'View Sub Component'
    ]);

    //      Subsidiary Component
    Permission::create([
      'type' => 'Subsidiary Component',
      'name' => 'List Of Subsidiary Component'
    ]);
    Permission::create([
      'type' => 'Subsidiary Component',
      'name' => 'Create Subsidiary Component'
    ]);
    Permission::create([
      'type' => 'Subsidiary Component',
      'name' => 'Manage Subsidiary Component'
    ]);
    Permission::create([
      'type' => 'Subsidiary Component',
      'name' => 'Delete Subsidiary Component'
    ]);
    Permission::create([
      'type' => 'Subsidiary Component',
      'name' => 'View Subsidiary Component'
    ]);

    //      Institute
    Permission::create([
      'type' => 'Institute',
      'name' => 'List Of Institute'
    ]);
    Permission::create([
      'type' => 'Institute',
      'name' => 'Create Institute'
    ]);
    Permission::create([
      'type' => 'Institute',
      'name' => 'Manage Institute'
    ]);
    Permission::create([
      'type' => 'Institute',
      'name' => 'Delete Institute'
    ]);
    Permission::create([
      'type' => 'Institute',
      'name' => 'View Institute'
    ]);

    //      Institute Head
    Permission::create([
      'type' => 'Institute User',
      'name' => 'List Of Institute User'
    ]);
    Permission::create([
      'type' => 'Institute User',
      'name' => 'Create Institute User'
    ]);
    Permission::create([
      'type' => 'Institute User',
      'name' => 'Manage Institute User'
    ]);
    Permission::create([
      'type' => 'Institute User',
      'name' => 'Delete Institute User'
    ]);
    Permission::create([
      'type' => 'Institute User',
      'name' => 'View Institute User'
    ]);

    //      Training
    Permission::create([
      'type' => 'Training',
      'name' => 'List Of Training'
    ]);
    Permission::create([
      'type' => 'Training',
      'name' => 'Create Training'
    ]);
    Permission::create([
      'type' => 'Training',
      'name' => 'Manage Training'
    ]);
    Permission::create([
      'type' => 'Training',
      'name' => 'Delete Training'
    ]);
    Permission::create([
      'type' => 'Training',
      'name' => 'View Training'
    ]);

    //      Training Member
    Permission::create([
      'type' => 'Training Member',
      'name' => 'List Of Training Member'
    ]);
    Permission::create([
      'type' => 'Training Member',
      'name' => 'Create Training Member'
    ]);
    Permission::create([
      'type' => 'Training Member',
      'name' => 'Manage Training Member'
    ]);

    Permission::create([
      'type' => 'Training Member',
      'name' => 'Delete Training Member'
    ]);
    Permission::create([
      'type' => 'Training Member',
      'name' => 'View Training Member'
    ]);


    //      Fiscal Year
    Permission::create([
      'type' => 'Fiscal Year',
      'name' => 'List Of Fiscal Year'
    ]);
    Permission::create([
      'type' => 'Fiscal Year',
      'name' => 'Create Fiscal Year'
    ]);
    Permission::create([
      'type' => 'Fiscal Year',
      'name' => 'Manage Fiscal Year'
    ]);
    Permission::create([
      'type' => 'Fiscal Year',
      'name' => 'Delete Fiscal Year'
    ]);
    Permission::create([
      'type' => 'Fiscal Year',
      'name' => 'View Fiscal Year'
    ]);

    //      Fiscal Period
    Permission::create([
      'type' => 'Fiscal Period',
      'name' => 'List Of Fiscal Period'
    ]);
    Permission::create([
      'type' => 'Fiscal Period',
      'name' => 'Create Fiscal Period'
    ]);
    Permission::create([
      'type' => 'Fiscal Period',
      'name' => 'Manage Fiscal Period'
    ]);
    Permission::create([
      'type' => 'Fiscal Period',
      'name' => 'Delete Fiscal Period'
    ]);
    Permission::create([
      'type' => 'Fiscal Period',
      'name' => 'View Fiscal Period'
    ]);


//     Fiscal Component Budget
    Permission::create([
      'type' => 'Component Budget',
      'name' => 'List Of Component Budget'
    ]);
    Permission::create([
      'type' => 'Component Budget',
      'name' => 'Create Component Budget'
    ]);
    Permission::create([
      'type' => 'Component Budget',
      'name' => 'Manage Component Budget'
    ]);
    Permission::create([
      'type' => 'Component Budget',
      'name' => 'Delete Component Budget'
    ]);
    Permission::create([
      'type' => 'Component Budget',
      'name' => 'View Component Budget'
    ]);

//     Component Budget Institute
    Permission::create([
      'type' => 'Component Institute Budget',
      'name' => 'List Of Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Component Institute Budget',
      'name' => 'Create Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Component Institute Budget',
      'name' => 'Manage Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Component Institute Budget',
      'name' => 'Delete Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Component Institute Budget',
      'name' => 'View Component Institute Budget'
    ]);

//     Sub Component Institute Budget
    Permission::create([
      'type' => 'Sub Component Institute Budget',
      'name' => 'List Of Sub Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Sub Component Institute Budget',
      'name' => 'Create Sub Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Sub Component Institute Budget',
      'name' => 'Manage Sub Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Sub Component Institute Budget',
      'name' => 'Delete Sub Component Institute Budget'
    ]);
    Permission::create([
      'type' => 'Sub Component Institute Budget',
      'name' => 'View Sub Component Institute Budget'
    ]);


//      Voucher Type
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'List Of Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'Create Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'Manage Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'Delete Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'View Voucher Type'
    ]);


    //      Voucher
    Permission::create([
      'type' => 'Voucher',
      'name' => 'List Of Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'Create Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'Manage Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'Delete Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'View Voucher'
    ]);

    //      Subsidiary Component code wise
    Permission::create([
      'type' => 'Report',
      'name' => 'Subsidiary Component code wise'
    ]);

    //      Subsidiary Component quarter wise
    Permission::create([
      'type' => 'Report',
      'name' => 'Subsidiary Component quarter wise'
    ]);
      //      Training Type
      Permission::create([
          'type' => 'Training Type',
          'name' => 'List Of Training Type'
      ]);
      Permission::create([
          'type' => 'Training Type',
          'name' => 'Create Training Type'
      ]);
      Permission::create([
          'type' => 'Training Type',
          'name' => 'Manage Training Type'
      ]);
      Permission::create([
          'type' => 'Training Type',
          'name' => 'Delete Training Type'
      ]);
      Permission::create([
          'type' => 'Training Type',
          'name' => 'View Training Type'
      ]);

      //      Training Batch
      Permission::create([
          'type' => 'Training Batch',
          'name' => 'List Of Training Batch'
      ]);
      Permission::create([
          'type' => 'Training Batch',
          'name' => 'Create Training Batch'
      ]);
      Permission::create([
          'type' => 'Training Batch',
          'name' => 'Manage Training Batch'
      ]);
      Permission::create([
          'type' => 'Training Batch',
          'name' => 'Delete Training Batch'
      ]);
      Permission::create([
          'type' => 'Training Batch',
          'name' => 'View Training Batch'
      ]);


      //      Project Idea
      Permission::create([
          'type' => 'Project Idea',
          'name' => 'List Of Project Idea'
      ]);
      Permission::create([
          'type' => 'Project Idea',
          'name' => 'Create Project Idea'
      ]);
      Permission::create([
          'type' => 'Project Idea',
          'name' => 'Manage Project Idea'
      ]);
      Permission::create([
          'type' => 'Project Idea',
          'name' => 'Delete Project Idea'
      ]);
      Permission::create([
          'type' => 'Project Idea',
          'name' => 'View Project Idea'
      ]);

//      Technology
      Permission::create([
          'type' => 'Technology',
          'name' => 'Create Technology'
      ]);
      Permission::create([
          'type' => 'Technology',
          'name' => 'Manage Technology'
      ]);
      Permission::create([
          'type' => 'Technology',
          'name' => 'Delete Technology'
      ]);
      Permission::create([
          'type' => 'Technology',
          'name' => 'List of Technology'
      ]);


//      Shift
      Permission::create([
          'type' => 'Shift',
          'name' => 'Create Shift'
      ]);
      Permission::create([
          'type' => 'Shift',
          'name' => 'Manage Shift'
      ]);
      Permission::create([
          'type' => 'Shift',
          'name' => 'Delete Shift'
      ]);
      Permission::create([
          'type' => 'Shift',
          'name' => 'List of Shift'
      ]);



//      Semester
      Permission::create([
          'type' => 'Semester',
          'name' => 'Create Semester'
      ]);
      Permission::create([
          'type' => 'Semester',
          'name' => 'Manage Semester'
      ]);
      Permission::create([
          'type' => 'Semester',
          'name' => 'Delete Semester'
      ]);
      Permission::create([
          'type' => 'Semester',
          'name' => 'List of Semester'
      ]);

//      Fixed Asset
      Permission::create([
          'type' => 'Inventory Fixed Asset',
          'name' => 'Create Inventory Fixed Asset'
      ]);
      Permission::create([
          'type' => 'Inventory Fixed Asset',
          'name' => 'Manage Inventory Fixed Asset'
      ]);
      Permission::create([
          'type' => 'Inventory Fixed Asset',
          'name' => 'Delete Inventory Fixed Asset'
      ]);
      Permission::create([
          'type' => 'Inventory Fixed Asset',
          'name' => 'List of Inventory Fixed Asset'
      ]);


  }
}
