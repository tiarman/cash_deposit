<?php

namespace App\Imports;

use App\Models\InstituteBuilding;
use App\Models\InstituteBuildingItem;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InstituteBuildingImport implements ToModel, WithHeadingRow {
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row) {
//        return new InstituteBuilding([
//          "institute_id" => auth()->user()->institute_id,
//          "name" => $row['building_name'],
//          "block_name" => $row['block_name'],
//          "floor_name" => $row['floor_no'],
//          "room_name" => $row['room_name'],
//          "room_no" => $row['room_no'],
//          "sn" => $row['sn'],
//          "name_of_item" => $row['name_of_item'],
//          "quantity" => $row['quantity'],
//          "accn_no" => $row['accn_no'],
//          'status' => $row['status'],
//          "remarks" => $row['remarks'],
//        ]);

//      dd($row);
    DB::beginTransaction();
    $data = [
      'institute_id' => auth()->user()->institute_id,
      'building_name' => $row['building_name'],
      'block_name' => $row['block_name'],
      'floor_name' => $row['floor_no'],
      'room_name' => $row['room_name'],
      'room_no' => $row['room_no']
    ];
    if (!($building = InstituteBuilding::where($data)->first())) {
      $data['sn'] = $row['sn'];
      $data['status'] = InstituteBuilding::$statusArrays[1];
      $building = InstituteBuilding::create($data);
    }

    $item = new InstituteBuildingItem();
    $item->institute_id = $building->institute_id;
    $item->institute_buildings_id = $building->id;
    $item->name = $row['name_of_item'];
    $item->quantity = $row['quantity'];
    $item->prefix = $row['prefix'] ?? null;
    $item->serial = $row['serial'] ?? null;
    $item->accn_no = $row['accn_no'];
    $item->remarks = $row['remarks'];
    $item->status = strtolower($row['status_activeinactive']);
    $item->save();
    DB::commit();
    return $building;
  }
}
