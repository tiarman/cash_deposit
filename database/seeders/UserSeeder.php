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
        'institute_id' => 1,
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

      $trainee = User::create([
        'name_en' => 'Arif Hosen',
        'username' => 'arif',
        'phone' => '01600000000',
        'email' => 'trainee@mail.com',
        'password' => bcrypt('12345600'),
        'email_verified_at' => now(),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead1 = User::create([
        'name_en' => 'Md Abdul Rauf',
        'name_bn' => 'মোঃ আব্দুল রউফ',
        'username' => 'Mdabdulrauf',
        'phone' => '01700000002',
        'email' => 'institute1@mail.com',
        'email_verified_at' => now(),
        'institute_id' => 3,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead2 = User::create([
        'name_en' => 'Md Mozibur Rahman',
        'name_bn' => 'মোঃ মজিবুর রহমান',
        'username' => 'MdMoziburRahman',
        'phone' => '01700000004',
        'email' => 'institute2@mail.com',
        'institute_id' => 2,
        'password' => bcrypt('12345600'),
        'email_verified_at' => now(),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead3 = User::create([
        'name_en' => 'Md. Shamshad Khalil',
        'name_bn' => 'মোঃ শামশাদ খলিল',
        'username' => 'MdShamshadKhalil01',
        'phone' => '01571247795',
        'email' => 'institute3@mail.com',
        'institute_id' => 3,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
        'email_verified_at' => now(),
      ]);
      $instituteHead4 = User::create([
        'name_en' => 'Md. Shamshad Khalil',
        'name_bn' => 'মোঃ শামশাদ খলিল',
        'username' => 'MdShamshadKhalil02',
        'phone' => '01712477953',
        'email' => 'institute4@mail.com',
        'institute_id' => 4,
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead5 = User::create([
        'name_en' => 'Md. Mobarak Hossen',
        'name_bn' => 'মোঃ মোবারক হোসেন',
        'username' => 'MdMobarakHossen02',
        'phone' => '01756157751',
        'email' => 'institute5@mail.com',
        'institute_id' => 5,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
        'email_verified_at' => now(),
      ]);
      $instituteHead6 = User::create([
        'name_en' => 'Mohammad Abdul Matin Howlader',
        'name_bn' => 'মোহাম্মদ আব্দুল মতিন হাওলাদার',
        'username' => 'MohammadAbdulMatinHowlader',
        'phone' => '01827557761',
        'email' => 'institute6@mail.com',
        'institute_id' => 6,
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);
      $instituteHead7 = User::create([
        'name_en' => 'Md. Anwarul Kabir',
        'name_bn' => 'মোঃ আনোয়ারুল কবির',
        'username' => 'MdAnwarulKabir',
        'email_verified_at' => now(),
        'phone' => '01712117219',
        'email' => 'institute7@mail.com',
        'institute_id' => 7,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead8 = User::create([
        'name_en' => 'Md. Ruhul Amin',
        'email_verified_at' => now(),
        'name_bn' => 'মোঃ রুহুল আমিন',
        'username' => 'MdRuhulAmin',
        'phone' => '01911227578',
        'email' => 'institute8@mail.com',
        'institute_id' => 8,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead9 = User::create([
        'name_en' => 'Harun-Or-Rashid',
        'name_bn' => 'হারুন-অর-রশিদ',
        'username' => 'HarunOrRashid',
        'phone' => '01761791777',
        'email' => 'institute9@mail.com',
        'institute_id' => 9,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
        'email_verified_at' => now(),
      ]);

      $instituteHead10 = User::create([
        'name_en' => 'Muhammad Hossainuzzaman Chowdhury',
        'name_bn' => 'মুহাম্মদ হোসেনুজ্জামান চৌধুরী',
        'username' => 'MuhammadHossainuzzamanChowdhury',
        'phone' => '01712583972',
        'email' => 'institute10@mail.com',
        'institute_id' => 10,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
        'email_verified_at' => now(),
      ]);

      $instituteHead11 = User::create([
        'name_en' => 'Md. Nurul Hakim',
        'name_bn' => 'মোঃ নুরুল হাকিম',
        'username' => 'MdNurulHakim',
        'phone' => '01556538883',
        'email' => 'institute11@mail.com',
        'institute_id' => 11,
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead12 = User::create([
        'name_en' => 'Md. Nurul Islam Talukder',
        'name_bn' => 'মোঃ নুরুল ইসলাম তালুকদার',
        'username' => 'MdNurulIslamTalukder',
        'phone' => '01935099087',
        'email' => 'institute12@mail.com',
        'institute_id' => 12,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
        'email_verified_at' => now(),
      ]);

      $instituteHead13 = User::create([
        'name_en' => 'Md. Jakir Hossen',
        'name_bn' => 'মোঃ জাকির হোসেন',
        'username' => 'MdJakirHossen',
        'phone' => '02-478864166',
        'email' => 'institute13@mail.com',
        'institute_id' => 13,
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead14 = User::create([
        'name_en' => 'Utpal Kumar Bhuyan',
        'name_bn' => 'উৎপল কুমার ভূঁইয়া',
        'username' => 'UtpalKumarBhuyan',
        'phone' => '01715678143',
        'email' => 'institute14@mail.com',
        'institute_id' => 14,
        'email_verified_at' => now(),
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $instituteHead15 = User::create([
        'name_en' => 'Samir Karmokar',
        'name_bn' => 'সমীর কর্মকারা',
        'username' => 'SamirKarmokar',
        'phone' => '01749172781',
        'email_verified_at' => now(),
        'email' => 'institute15@mail.com',
        'institute_id' => 15,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);




      $instituteTrainee2 = User::create([
        'name_en' => 'Towhidul Hossen',
        'name_bn' => 'তৌহিদুল হোসেন',
        'username' => 'towhidul',
        'email_verified_at' => now(),
        'phone' => '01700000008',
        'email' => 'towhidul@mail.com',
        'institute_id' => 2,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[0],
      ]);

      $instituteTrainee3 = User::create([
        'name_en' => 'Aftab Uddin Fakir',
        'name_bn' => 'আফতাব উদ্দিন ফকির',
        'username' => 'AftabUddinFakir',
        'phone' => '01700000212',
        'email' => 'aftabfakir@mail.com',
        'institute_id' => 2,
        'password' => bcrypt('12345600'),
        'email_verified_at' => now(),
        'status' => User::$statusArrays[0],
      ]);

      $industry = User::create([
        'name_en' => 'Samsung',
        'name_bn' => 'স্যামসাং',
        'username' => 'Samsung1',
        'phone' => '01700221212',
        'email' => 'industry11@mail.com',
        'institute_id' => 2,
        'password' => bcrypt('12345600'),
        'email_verified_at' => now(),
        'status' => User::$statusArrays[0],
      ]);

      $student = User::create([
        'name_en' => 'Md Abdul Raufsas',
        'name_bn' => 'মোঃ আব্দুল রউফ',
        'username' => 'Mdabdulrausaf',
        'phone' => '01701100002',
        'email' => 'st@mail.com',
        'email_verified_at' => now(),
        'institute_id' => 3,
        'password' => bcrypt('12345600'),
        'status' => User::$statusArrays[1],
      ]);

      $user->assignRole('Super Admin');
      $student->assignRole('Student');
      $usertwo->assignRole('Super Admin');
      $trainee->assignRole('Trainee');
      $industry->assignRole('Industry');

      $instituteHead1->assignRole('Institute Head');
      $instituteHead2->assignRole('Institute Head');
      $instituteHead3->assignRole('Institute Head');
      $instituteHead4->assignRole('Institute Head');
      $instituteHead5->assignRole('Institute Head');
      $instituteHead6->assignRole('Institute Head');
      $instituteHead7->assignRole('Institute Head');
      $instituteHead9->assignRole('Institute Head');
      $instituteHead10->assignRole('Institute Head');
      $instituteHead11->assignRole('Institute Head');
      $instituteHead12->assignRole('Institute Head');
      $instituteHead13->assignRole('Institute Head');
      $instituteHead14->assignRole('Institute Head');
      $instituteHead15->assignRole('Institute Head');

      $instituteTrainee2->assignRole('Trainee');
      $instituteTrainee3->assignRole('Trainee');

    }
}
