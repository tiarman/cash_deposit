<?php

namespace Database\Seeders;

use App\Models\FiscalPeriod;
use App\Models\FiscalYear;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiscalYearSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    FiscalYear::truncate();
    $data = [
      [
        'code' => '20',
        'start_date' => '2020-07-01',
        'end_date' => '2021-06-30',
        'status' => FiscalYear::$statusArrayss[0],
      ],
      [
        'code' => '21',
        'start_date' => '2021-07-01',
        'end_date' => '2022-06-30',
        'status' => FiscalYear::$statusArrayss[0],
      ],
      [
        'code' => '22',
        'start_date' => '2022-07-01',
        'end_date' => '2023-06-30',
        'status' => FiscalYear::$statusArrayss[1],
      ],
      [
        'code' => '23',
        'start_date' => '2023-07-01',
        'end_date' => '2024-06-30',
        'status' => FiscalYear::$statusArrayss[0],
      ],
    ];
    foreach ($data as $fsYear) {
      $fiscalYear = new FiscalYear();
      $fiscalYear->code = $fsYear['code'];
      $fiscalYear->start_date = $fsYear['start_date'];
      $fiscalYear->end_date = $fsYear['end_date'];
      $fiscalYear->status = $fsYear['status'];
      $fiscalYear->created_by = 1;
      if ($fiscalYear->save()) {

        if ($fiscalYear->status === FiscalYear::$statusArrayss[1]) {
          FiscalYear::where('id', '!=', $fiscalYear->id)->update(['status' => FiscalYear::$statusArrayss[0]]);
        }

        $tempDate = Carbon::parse($fiscalYear->start_date);
        $endDate = Carbon::parse($fiscalYear->end_date);
        $qut = 1;
        $count = 1;
        while ($tempDate->format('01-m-Y') !== $endDate->format('01-m-Y')) {
          $fiscalPeriod = new FiscalPeriod();
          $fiscalPeriod->fiscal_year_id = $fiscalYear->id;
          $fiscalPeriod->month_name = $tempDate->format('F');
          $fiscalPeriod->start_date = $tempDate->startOfMonth()->format('Y-m-d');
          $fiscalPeriod->end_date = $tempDate->endOfMonth()->format('Y-m-d');;
          $fiscalPeriod->quarter_no = $qut;
          $fiscalPeriod->created_by = 1;
          $fiscalPeriod->save();

          $tempDate->startOfMonth()->addMonth();

          $count += 1;
          if ($count == 4) {
            $count = 1;
            $qut += 1;
          }
        }
        $fiscalPeriod1 = new FiscalPeriod();
        $fiscalPeriod1->fiscal_year_id = $fiscalYear->id;
        $fiscalPeriod1->month_name = $endDate->format('F');
        $fiscalPeriod1->start_date = $endDate->startOfMonth()->format('Y-m-d');
        $fiscalPeriod1->end_date = $endDate->endOfMonth()->format('Y-m-d');;
        $fiscalPeriod1->quarter_no = $qut;
        $fiscalPeriod1->created_by = 1;
        $fiscalPeriod1->save();
      }
    }
  }
}
