<?php

namespace App\Http\Controllers\Institute;

use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Imports\InstituteBuildingImport;
use App\Models\InstituteBuilding;
use App\Models\InstituteBuildingItem;
use Exception;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class InstituteBuildingController extends Controller {

  /**
   * @param $id
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
   */
  public function indexOfItem($id = null) {
    if ($data['building'] = InstituteBuilding::with('items')->where('id', $id)->where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->first()) {
      return view('admin.institute.building.itemList', $data);
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Asset not found.');
  }


  public function itemManage(Request $request, $id = null) {
    if ($item = InstituteBuildingItem::find($id)) {
      if ($request->isMethod('POST')) {
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->accn_no = $request->accn_no;
        $item->status = $request->status;
        $item->remarks = $request->remarks;
        if ($item->save()) {
          return RedirectHelper::routeSuccessWithParams('admin.institute.building.item.list', '<strong>Congratulations!!!</strong> Item updated.', ['id' => $item->institute_buildings_id]);
        }
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Update not possible.');
      }
      $data['item'] = $item;
      return view('admin.institute.building.itemManage', $data);
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Item not found.');
  }


  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index() {
    $data['buildings'] = InstituteBuilding::withCount('items')->where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->get();
    return view('admin.institute.building.list', $data);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function create() {
    return view('admin.institute.building.create');
  }


  public function manage($id = null) {
    if ($data['building'] = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->find($id)) {
      return view('admin.institute.building.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.institute.building.list', '<strong>Sorry!!!</strong> Building not found');
  }


  public function store(Request $request) {
//    return $request;
    $message = '<strong>Congratulations!!!</strong> Fixed Asset successfully';
    $rules = [
      "building_name" => 'required',
      "block_name" => 'required',
      "floor_name" => 'required',
      "room_name" => 'required',
      "room_no" => 'required',
      "sn" => 'required',
//      "name_of_item" => 'required',
//      "accn_no" => 'required',
//      "quantity" => 'required',
//      "remarks" => 'nullable',
//      'status' => ['required', Rule::in(InstituteBuilding::$statusArrays)],
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()]);
    }
    DB::beginTransaction();
    try {
      $data = ['institute_id' => auth()->user()->institute_id,
        'building_name' => $request->building_name,
        'block_name' => $request->block_name,
        'floor_name' => $request->floor_name,
        'room_name' => $request->room_name,
        'room_no' => $request->room_no];
      if (!($building = InstituteBuilding::where($data)->first())) {
        $data['sn'] = $request->sn;
        $data['status'] = InstituteBuilding::$statusArrays[1];
        $building = InstituteBuilding::create($data);
      }
//      return $request;
      if ($request->filled('serial_to')) {
//        foreach (range($request->serial, $request->serial_to) as $seral) {
          $item = new InstituteBuildingItem();
          $item->institute_id = $building->institute_id;
          $item->institute_buildings_id = $building->id;
          $item->name = $request->name_of_item;
          $item->quantity = $request->quantity;
          $item->prefix = $request->prefix;
          $item->serial = $request->serial .' to '.$request->serial_to;
          $item->accn_no = $request->prefix . $item->serial;
          $item->remarks = $request->remarks;
          $item->status = $request->status;
          $item->save();
//        }
      } else {
        $item = new InstituteBuildingItem();
        $item->institute_id = $building->institute_id;
        $item->institute_buildings_id = $building->id;
        $item->name = $request->name_of_item;
        $item->quantity = $request->quantity;
        $item->prefix = $request->prefix;
        $item->serial = $request->serial;
        $item->accn_no = $request->prefix . $request->serial;
        $item->remarks = $request->remarks;
        $item->status = $request->status;
        $item->save();
      }
      DB::commit();
      $items = InstituteBuildingItem::where('institute_buildings_id', $building->id)->get()->map(function ($item) {
        $item->edit_url = route('admin.institute.building.item.manage', $item->id);
        return $item;
      });
      return response()->json(['success' => $message, 'datas' => $items]);
    } catch (\Exception $e) {
      DB::rollBack();
      return RedirectHelper::backWithInputFromException();
    }
  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $user = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->find($id);
      if ($user->delete() && InstituteBuildingItem::where('institute_buildings_id', $id)->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }

  public function itemDestroy(Request $request){
    $id = $request->post('id');

    try{
       $buildingItem = InstituteBuildingItem::find($id);
      if($buildingItem->delete()){
        return 'success';
      }
    }
    catch(Exception $e){

    }
  }


  public function import(Request $request) {
    Excel::import(new InstituteBuildingImport, $request->file);
    return RedirectHelper::back('<strong>Congratulation!!! </strong> Import Successful.');
  }



}
