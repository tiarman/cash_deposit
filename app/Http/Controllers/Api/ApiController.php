<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComponentBudget;
use App\Models\ComponentInstituteBudget;
use App\Models\District;
use App\Models\Institute;
use App\Models\SubComponent;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ApiController extends Controller {
  public function districts($division_id) {
    $data['districts'] = District::where("division_id", $division_id)
      ->get(["name", "id"]);

    return response()->json($data);
  }
  public function institutes($institute_type_id) {
    $data['institutes'] = Institute::where("institute_type_id", $institute_type_id)
      ->get(["name", "id"]);

    return response()->json($data);
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function upazilas($district_id) {
    $data['upazilas'] = Upazila::where("district_id", $district_id)
      ->get(["name", "id"]);

    return response()->json($data);
  }


  /**
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function getComponentBudget($id): \Illuminate\Http\JsonResponse {
    $data['budgets'] = ComponentBudget::where('fiscal_year_id', $id)->with('component:id,name')
      ->with('institutecomponentbudgets')->
    select('id', 'component_id', 'annual_budget', 'fiscal_year_id')->get()->map(function ($sinBudget) {
      $bud = new \stdClass();
      $bud->annual_budget = $sinBudget->annual_budget;
      $bud->component = $sinBudget->component;
      $bud->component_id = $sinBudget->component_id;
      $bud->fiscal_year_id = $sinBudget->fiscal_year_id;
      $bud->id = $sinBudget->id;
      $bud->availableBudget = ($bud->annual_budget - ($sinBudget->institutecomponentbudgets ? $sinBudget->institutecomponentbudgets->sum('annual_budget') : 0));
      $bud->disabled = ($bud->availableBudget < 1);
      return $bud;
    });
    return response()->json($data);
  }


  /**
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function getComponentBudgetFromYearAndInstitute($year_id, $institute_id): \Illuminate\Http\JsonResponse {
    $data['budgets'] = ComponentInstituteBudget::where('fiscal_year_id', $year_id)->where('institute_id', $institute_id)
      ->with('component:id,name', 'institutesubcomponentbudgets')->
    select('id', 'component_id', 'annual_budget', 'fiscal_year_id')->get()->map(function ($sinBudget) {
        $bud = new \stdClass();
        $bud->annual_budget = $sinBudget->annual_budget;
        $bud->component = $sinBudget->component;
        $bud->component_id = $sinBudget->component_id;
        $bud->fiscal_year_id = $sinBudget->fiscal_year_id;
        $bud->id = $sinBudget->id;
        $bud->availableBudget = ($bud->annual_budget - ($sinBudget->institutesubcomponentbudgets ? $sinBudget->institutesubcomponentbudgets->sum('annual_budget') : 0));
        $bud->disabled = ($bud->availableBudget < 1);
        return $bud;
      });
    return response()->json($data);
  }


  /**
   * @param $component_id
   * @return \Illuminate\Http\JsonResponse
   */
  public function getSubComponent($component_id): \Illuminate\Http\JsonResponse {
    $data['subcomponent'] = SubComponent::where('component_id', $component_id)
      ->select("name", "id")->get();
    return response()->json($data);
  }

  /**
   * @return JsonResponse
   */
  public function users() {
    $users = User::whereHas('institute')->whereHas('roles')->with('institute:id,name', 'roles')->select('id', 'name_en', 'institute_id')->orderBy('name_en')->get()->map(function ($item, $key){
      $user = new stdClass();
      $user->id = $item->id;
      $user->name = $item->name_en;
      $user->name_bn = $item->name_bn;
      $user->role = $item->roles->first()?->name;
      $user->institute = $item->institute?->name;
      return $user;
    });
    return response()->json($users);
  }
}
