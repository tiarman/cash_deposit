<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\InstituteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $limit = InstituteType::count();

      Institute::create([
        'institute_head_id' => 1,
        'name' => 'Bhola Technical school and College',
        'name_bn' => 'ভোলা টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '40019',
        'phone' => '0491-61417',
        'email' => 'tsc.bhola@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 4,
        'district_id' => 34,
      ]);
      Institute::create([
        'institute_head_id' => 5,
        'name' => 'Brahmanbaria Technical School And College',
        'name_bn' => 'ব্রাহ্মণবাড়িয়া টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '64012',
        'phone' => '0851-58284',
        'email' => 'bbariatsc@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 3,
      ]);
      Institute::create([
        'institute_head_id' => 6,
        'name' => 'Chandpur Technical School and College',
        'name_bn' => 'চাঁদপুর টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '66021',
        'phone' => '0841-65098',
        'email' => 'chandpurtsc@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 6,
        'upazila_id' => 53,
      ]);


      Institute::create([
        'institute_head_id' => 7,
        'name' => 'Bangladesh Institute of Glass and Ceramics',
        'name_bn' => 'বাংলাদেশ ইনস্টিটিউট অফ গ্লাস অ্যান্ড সিরামিকস',
        'code' => '50003',
        'phone' => '88-02-48117868',
        'email' => 'principal_bigc@yahoo.com;',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 6,
        'district_id' => 47,
      ]);
      Institute::create([
        'institute_head_id' => 8,
        'name' => 'Bangladesh Survey Institute',
        'name_bn' => 'বাংলাদেশ সার্ভে ইনস্টিটিউট',
        'code' => '65056',
        'phone' => '88-081-68477',
        'email' => 'bsi65056@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 1,
      ]);
      Institute::create([
        'institute_head_id' => 9,
        'name' => 'Bangladesh Sweden Polytechnic Institute',
        'name_bn' => 'বাংলাদেশ সুইডেন পলিটেকনিক ইনস্টিটিউট',
        'code' => '72007',
        'phone' => '88-02334461404',
        'email' => 'principal.bspi@yahoo.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 4,
      ]);
      Institute::create([
        'institute_head_id' => 10,
        'name' => 'Barguna Polytechnic Institute',
        'name_bn' => 'বরগুনা পলিটেকনিক ইনস্টিটিউট',
        'code' => '38033',
        'phone' => '88-0448 -63460',
        'email' => 'prin.barguna@gmail.com',
        'address' => '=',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 4,
        'district_id' => 34,
      ]);
      Institute::create([
        'institute_head_id' => 11,
        'name' => 'Barisal Polytechnic Institute',
        'name_bn' => 'বরিশাল পলিটেকনিক ইনস্টিটিউট',
        'code' => '42045',
        'phone' => '88-0431-64684',
        'email' => 'barisal.poly@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 6,
        'district_id' => 47,
      ]);
      Institute::create([
        'institute_head_id' => 12,
        'name' => 'Bagerhat Technical School and College',
        'name_bn' => 'বাগেরহাট টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '36021',
        'phone' => '0468-62531',
        'email' => 'tscbager19@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 3,
        'district_id' => 28,
      ]);
      Institute::create([
        'institute_head_id' => 13,
        'name' => 'Bancharampur Technical school and College',
        'name_bn' => 'বাঞ্ছারামপুর টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '64013',
        'phone' => '08523-5623',
        'email' => 'btsc_64013@yahoo.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 11,
      ]);
      Institute::create([
        'institute_head_id' => 14,
        'name' => 'Bandarban Technical School and College',
        'name_bn' => 'বান্দরবান টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '73002',
        'phone' => '0361-62791',
        'email' => 'bandarbantsc@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 11,
      ]);
      Institute::create([
        'institute_head_id' => 15,
        'name' => 'Barguna Technical school and College',
        'name_bn' => 'বরগুনা টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '38018',
        'phone' => '0448-62178',
        'email' => 'tscbarguna64@yahoo.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 4,
        'district_id' => 35,
      ]);
      Institute::create([
        'institute_head_id' => 16,
        'name' => 'Barisal Technical School and College',
        'name_bn' => 'বরিশাল টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '42029',
        'phone' => '02-478864166',
        'email' => 'btsc95@yahoo.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 4,
        'district_id' => 33,
      ]);
      Institute::create([
        'institute_head_id' => 17,
        'name' => 'Begumganj Technical School And College',
        'name_bn' => 'বেগমগঞ্জ টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '68018',
        'phone' => '0321-51470',
        'email' => 'tscbegum@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 1,
        'district_id' => 8,
      ]);
      Institute::create([
        'institute_head_id' => 18,
        'name' => 'Bhairab Technical school and College',
        'name_bn' => 'ভৈরব টেকনিক্যাল স্কুল অ্যান্ড কলেজ',
        'code' => '59019',
        'phone' => '02-9470136',
        'email' => 'tsc.bhairab@gmail.com',
        'address' => '-',
        'institute_type_id' => collect(range(1, $limit))->random(),
        'status' => Institute::$statusArrays[1],
        'division_id' => 6,
        'district_id' => 45,
      ]);

    }
}
