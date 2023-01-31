<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\InstituteBuilding;
use App\Models\InstituteBuildingItem;
use App\Models\InstituteType;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class SearchController extends Controller
{
  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchParticipateType(Request $request): \Illuminate\Http\JsonResponse {
    $data = Training::where('participate_type', 'LIKE', '%' . $request->search . '%')->groupBy('participate_type')->orderBy('participate_type')->select('participate_type as id', 'participate_type as label')->take(10)->get();
    return response()->json($data);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchBuildingName(Request $request): \Illuminate\Http\JsonResponse {
    $data = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->where('building_name', 'LIKE', '%' . $request->search . '%')->groupBy('building_name')->orderBy('building_name')->select('building_name as id', 'building_name as label')->take(10)->get();
    return response()->json($data);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchBlockName(Request $request): \Illuminate\Http\JsonResponse {
    $data = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->where('block_name', 'LIKE', '%' . $request->search . '%')->groupBy('block_name')->orderBy('block_name')->select('block_name as id', 'block_name as label')->take(10)->get();
    return response()->json($data);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchFloorName(Request $request): \Illuminate\Http\JsonResponse {
    $data = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->where('floor_name', 'LIKE', '%' . $request->search . '%')->groupBy('floor_name')->orderBy('floor_name')->select('floor_name as id', 'floor_name as label')->take(10)->get();
    return response()->json($data);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchRoomName(Request $request): \Illuminate\Http\JsonResponse {
    $data = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->where('room_name', 'LIKE', '%' . $request->search . '%')->groupBy('room_name')->orderBy('room_name')->select('room_name as id', 'room_name as label')->take(10)->get();
    return response()->json($data);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchRoomNo(Request $request): \Illuminate\Http\JsonResponse {
    $data = InstituteBuilding::where('institute_id', auth()->user()->institute_id)->where('room_no', 'LIKE', '%' . $request->search . '%')->groupBy('room_no')->orderBy('room_no')->select('room_no as id', 'room_no as label')->take(10)->get();
    return response()->json($data);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchItemName(Request $request): \Illuminate\Http\JsonResponse {
    $data = InstituteBuildingItem::where('institute_id', auth()->user()->institute_id)->where('name', 'LIKE', '%' . $request->search . '%')->groupBy('name')->orderBy('name')->select('name as id', 'name as label')->take(10)->get();
    return response()->json($data);
  }


  public function searchUserName(Request $request): \Illuminate\Http\JsonResponse {
    $data = User::where('institute_id',auth()->user()->institute_id)->where('board_roll', 'LIKE', '%' . $request->search . '%')->select('board_roll as id', 'board_roll as label', 'id as user_id', 'name_en', 'trade_technology','semester')->take(10)->get();
    return response()->json($data);
  }


  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchInstituteFromTypeAndDivision(Request $request) {
    $institute = Institute::query();
    if ($request->filled('type')){
      $institute = $institute->where('type', $request->type);
    }
    if ($request->filled('repDivision')){
      $institute = $institute->where('division_id', $request->repDivision);
    }
    $institute = $institute->select('id', 'name')->get();
    return response()->json($institute);
  }


  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function searchUserFromInstitute(Request $request) {
    if ($request->filled('institute') && $ins = Institute::find($request->institute)){
      $data = User::whereHas('institute')->whereHas('roles')->with('institute:id,name', 'roles')
        ->where('institute_id', $ins->id)
        ->select('id', 'name_en', 'institute_id')->orderBy('name_en')->get()->map(function ($item, $key) {
          $user = new stdClass();
          $user->id = $item->id;
          $user->name = $item->name_en;
          $user->name_bn = $item->name_bn;
          $user->role = $item->roles->first()?->name;
          $user->institute = $item->institute?->name;
          return $user;
        });
    return response()->json($data);
    }
  }
}
