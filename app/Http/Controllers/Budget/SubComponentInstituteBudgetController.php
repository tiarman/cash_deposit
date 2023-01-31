<?php

namespace App\Http\Controllers\Budget;

use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\ComponentBudget;
use App\Models\ComponentInstituteBudget;
use App\Models\FiscalYear;
use App\Models\SubComponentInstituteBudget;
use App\Models\Institute;
use App\Models\SubComponent;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SubComponentInstituteBudgetController extends Controller {

  public function index() {
    $data['datas'] = SubComponentInstituteBudget::with('subcomponent:id,name,component_id', 'subcomponent.component:id,name', 'creator:id,name_en', 'editor:id,name_en')->orderby('id', 'desc')->get();
    return view('admin.budget.subComponentInstitute.list', $data);
  }


  public function create() {
    $data['fsYears'] = FiscalYear::select('id', 'code', 'start_date', 'end_date')->orderBy('code')->get();
    $data['institutes'] = Institute::select('id', 'name')->orderBy('name')->get();
    $data['budgets'] = ComponentInstituteBudget::with('component:id,name')->orderBy('id')->get();
    $data['subcomponents'] = SubComponent::select('id', 'name')->orderBy('name')->get();
    return view('admin.budget.subComponentInstitute.create', $data);
  }


  public function manage($id = null) {
    if ($data['scib'] = SubComponentInstituteBudget::find($id)) {
      $data['fsYears'] = FiscalYear::select('id', 'code', 'start_date', 'end_date')->orderBy('code')->get();
      $data['institutes'] = Institute::select('id', 'name')->orderBy('name')->get();
      $data['budgets'] = ComponentInstituteBudget::with('component:id,name')->orderBy('id')->get();
      $data['subcomponents'] = SubComponent::select('id', 'name')->orderBy('name')->get();
      return view('admin.budget.subComponentInstitute.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.budget.sub.component.institute.list', '<strong>Sorry!!!</strong> Sub Component budget for Institute Year not found');
  }


  public function store(Request $request) {
//    return $request;
    $message = '<strong>Congratulations!!!</strong> Sub Component budget for institute successfully ';
    $rules = [
      'fiscal_year_id' => 'required',
      'institute_id' => 'required',
      'component_id' => 'required',
      'sub_component_id' => 'required',
      'annual_budget' => 'required',
    ];
    if (!($budget = ComponentInstituteBudget::find($request->component_id))) {
      return RedirectHelper::backWithInput('<strong>Sorry!!! </strong> Component budget for institute not found.');
    }

    $available = $budget->annual_budget;
    if ($budget->institutesubcomponentbudgets) {
      $available = ($available - $budget->institutesubcomponentbudgets->sum('annual_budget'));
    }

    if ($request->has('id')) {
      if (SubComponentInstituteBudget::whereNot('id', $request->id)->where('institute_id', $request->institute_id)
        ->where('sub_component_id', $request->sub_component_id)->where('fiscal_year_id', $request->fiscal_year_id)->first()) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Already has one with same Sub component with fiscal year with this institute.');
      }
      $subComponentInstituteBudget = SubComponentInstituteBudget::find($request->id);

      $available = ($available + $subComponentInstituteBudget->annual_budget);

      $message = $message . ' updated';
      $subComponentInstituteBudget->updated_by = \auth()->id();
    } else {
      if (SubComponentInstituteBudget::where('institute_id', $request->institute_id)
        ->where('sub_component_id', $request->sub_component_id)->where('fiscal_year_id', $request->fiscal_year_id)->first()) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Already has one with same Sub component with fiscal year with this institute.');
      }
      $subComponentInstituteBudget = new SubComponentInstituteBudget;
      $message = $message . ' created';
      $subComponentInstituteBudget->created_by = \auth()->id();
    }
    $request->validate($rules);
    try {
//      return $available;
      if ($available < $request->annual_budget) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Institute Component hasn\'t enough budget available.');
      }

      $subComponentInstituteBudget->component_institute_budget_id = $budget->id;
      $subComponentInstituteBudget->fiscal_year_id = $request->fiscal_year_id;
      $subComponentInstituteBudget->institute_id = $request->institute_id;
      $subComponentInstituteBudget->sub_component_id = $request->sub_component_id;
      $subComponentInstituteBudget->annual_budget = $request->annual_budget;

      $subComponentInstituteBudget->type = $request->type;

      $subComponentInstituteBudget->m1 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m1 : null;
      $subComponentInstituteBudget->m2 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m2 : null;
      $subComponentInstituteBudget->m3 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m3 : null;
      $subComponentInstituteBudget->m4 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m4 : null;
      $subComponentInstituteBudget->m5 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m5 : null;
      $subComponentInstituteBudget->m6 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m6 : null;
      $subComponentInstituteBudget->m7 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m7 : null;
      $subComponentInstituteBudget->m8 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m8 : null;
      $subComponentInstituteBudget->m9 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m9 : null;
      $subComponentInstituteBudget->m10 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m10 : null;
      $subComponentInstituteBudget->m11 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m11 : null;
      $subComponentInstituteBudget->m12 = ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) ? $request->m12 : null;

      if ($subComponentInstituteBudget->type === SubComponentInstituteBudget::$typeArrays[1]) {
        $month_budget = $request->m1 + $request->m2 + $request->m3 + $request->m4 + $request->m5 + $request->m6 + $request->m7 + $request->m8 + $request->m9 + $request->m10 + $request->m11 + $request->m12;
        if ($request->annual_budget != round($month_budget)) {
          return RedirectHelper::backWithInput('<strong>Sorry!!! </strong> Annual budget and total month is not match.');
        }
      }
      if ($subComponentInstituteBudget->save()) {
        return RedirectHelper::routeSuccess('admin.budget.sub.component.institute.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }
  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $fiscalYear = ComponentBudget::find($id);
      if ($fiscalYear->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
