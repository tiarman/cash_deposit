<?php

namespace Database\Seeders;

use App\Models\VoucherType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

      VoucherType::truncate();
//      BANK PAYMENT VOUCHERS, BANK RECEIPT VOUCHERS, CASH PAYMENT VOUCHERS, CASH RECEIPT VOUCHERS, JOURNAL VOUCHER
      VoucherType::create([
        'name' => 'BANK PAYMENT VOUCHERS',
        'short_name' => 'VBP'
      ]);
      VoucherType::create([
        'name' => 'BANK RECEIPT VOUCHERS',
        'short_name' => 'VBR'
      ]);
      VoucherType::create([
        'name' => 'CASH PAYMENT VOUCHERS',
        'short_name' => 'VCP'
      ]);
      VoucherType::create([
        'name' => 'CASH RECEIPT VOUCHERS',
        'short_name' => 'VCR'
      ]);
      VoucherType::create([
        'name' => 'JOURNAL VOUCHER',
        'short_name' => 'VJ'
      ]);
    }
}
