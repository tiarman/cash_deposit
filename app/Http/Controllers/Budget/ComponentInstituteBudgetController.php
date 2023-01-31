<?php

namespace App\Http\Controllers\Budget;

use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\ComponentBudget;
use App\Models\ComponentInstituteBudget;
use App\Models\FiscalYear;
use App\Models\Institute;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ComponentInstituteBudgetController extends Controller {

  public function index() {
    $data['datas'] = ComponentInstituteBudget::with('componentbudget:id,annual_budget', 'component:id,name', 'institute:id,name', 'year:id,code', 'creator:id,name_en', 'editor:id,name_en')->orderby('id', 'desc')->get();
    return view('admin.budget.componentInstitute.list', $data);
  }


  public function create() {
    $data['fsYears'] = FiscalYear::select('id', 'code', 'start_date', 'end_date')->orderBy('code')->get();
//    $data['budgets'] = ComponentBudget::with('component:id,name')->with('institutecomponentbudgets')->
//    select('id', 'component_id', 'annual_budget', 'fiscal_year_id')->get()->map(function ($sinBudget) {
//      $bud = new \stdClass();
//      $bud->annual_budget = $sinBudget->annual_budget;
//      $bud->component = $sinBudget->component;
//      $bud->component_id = $sinBudget->component_id;
//      $bud->fiscal_year_id = $sinBudget->fiscal_year_id;
//      $bud->id = $sinBudget->id;
//      $bud->availableBudget = ($bud->annual_budget - ($sinBudget->institutecomponentbudgets ? $sinBudget->institutecomponentbudgets->sum('annual_budget') : 0));
//      $bud->disabled = ($bud->availableBudget < 1);
//      return $bud;
//    });
    $data['institutes'] = Institute::select('id', 'name')->orderBy('name')->get();
    return view('admin.budget.componentInstitute.create', $data);
  }


  public function manage($id = null) {
    if ($data['cib'] = ComponentInstituteBudget::find($id)) {
      $data['fsYears'] = FiscalYear::select('id', 'code', 'start_date', 'end_date')->orderBy('code')->get();
      $data['institutes'] = Institute::select('id', 'name')->orderBy('name')->get();
      $data['budgets'] = ComponentBudget::with('component:id,name')->with('institutecomponentbudgets')->
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
      return view('admin.budget.componentInstitute.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.budget.component.institute.list', '<strong>Sorry!!!</strong> Component Institute Budget not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Component budget for institute successfully ';
    $rules = [
      'fiscal_year_id' => 'required',
      'component_id' => 'required',
      'institute_id' => 'required',
      'annual_budget' => 'required',
    ];
    if (!($budget = ComponentBudget::find($request->component_id))) {
      return RedirectHelper::backWithInput('<strong>Sorry!!! </strong> Component Budget not found.');
    }

    $available = $budget->annual_budget;
    if ($budget->institutecomponentbudgets) {
      $available = ($available - $budget->institutecomponentbudgets->sum('annual_budget'));
    }

    if ($request->has('id')) {
      if (ComponentInstituteBudget::whereNot('id', $request->id)->where('institute_id', $request->institute_id)
        ->where('component_budget_id', $request->component_id)->where('fiscal_year_id', $request->fiscal_year_id)->first()) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Already has one with same component with fiscal year with this institute.');
      }
      $fiscalcomponent = ComponentInstituteBudget::find($request->id);

      $available = ($available + $fiscalcomponent->annual_budget);

      $message = $message . ' updated';
      $fiscalcomponent->updated_by = \auth()->id();
    } else {
      if (ComponentInstituteBudget::where('institute_id', $request->institute_id)
        ->where('component_budget_id', $request->component_id)->where('fiscal_year_id', $request->fiscal_year_id)->first()) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Already has one with same component with fiscal year with this institute.');
      }
      $fiscalcomponent = new ComponentInstituteBudget;
      $message = $message . ' created';
      $fiscalcomponent->created_by = \auth()->id();
    }
    $request->validate($rules);
    try {
      if ($available < $request->annual_budget) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Component hasn\'t enough budget available.');
      }
      $fiscalcomponent->component_budget_id = $budget->id;
      $fiscalcomponent->component_id = $budget->component_id;
      $fiscalcomponent->fiscal_year_id = $budget->fiscal_year_id;
      $fiscalcomponent->institute_id = $request->institute_id;
      $fiscalcomponent->annual_budget = $request->annual_budget;

      $fiscalcomponent->type = $request->type;

      $fiscalcomponent->m1 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m1 : null;
      $fiscalcomponent->m2 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m2 : null;
      $fiscalcomponent->m3 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m3 : null;
      $fiscalcomponent->m4 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m4 : null;
      $fiscalcomponent->m5 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m5 : null;
      $fiscalcomponent->m6 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m6 : null;
      $fiscalcomponent->m7 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m7 : null;
      $fiscalcomponent->m8 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m8 : null;
      $fiscalcomponent->m9 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m9 : null;
      $fiscalcomponent->m10 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m10 : null;
      $fiscalcomponent->m11 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m11 : null;
      $fiscalcomponent->m12 = ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) ? $request->m12 : null;

      if ($fiscalcomponent->type === ComponentInstituteBudget::$typeArrays[1]) {
        $month_budget = $request->m1 + $request->m2 + $request->m3 + $request->m4 + $request->m5 + $request->m6 + $request->m7 + $request->m8 + $request->m9 + $request->m10 + $request->m11 + $request->m12;
        if ($request->annual_budget != round($month_budget)) {
          return RedirectHelper::backWithInput('<strong>Sorry!!! </strong> Annual budget and total month is not match.');
        }
      }
      if ($fiscalcomponent->save()) {
        return RedirectHelper::routeSuccess('admin.budget.component.institute.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $fiscalYear = ComponentInstituteBudget::find($id);
      if ($fiscalYear->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
