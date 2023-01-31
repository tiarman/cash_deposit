<?php

namespace App\Http\Controllers\Budget;

use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ComponentBudget;
use App\Models\FiscalYear;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ComponentBudgetController extends Controller {


  public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
    $data['datas'] = ComponentBudget::with('component:id,name', 'creator:id,name_en', 'editor:id,name_en', 'year:id,code')->with('institutecomponentbudgets')->
    select('id', 'created_by', 'updated_by', 'component_id', 'annual_budget', 'fiscal_year_id')->orderby('id', 'desc')->get()->map(function ($sinBudget) {
      $bud = new \stdClass();
      $bud->annual_budget = $sinBudget->annual_budget;
      $bud->component = $sinBudget->component;
      $bud->component_id = $sinBudget->component_id;
      $bud->fiscal_year_id = $sinBudget->fiscal_year_id;
      $bud->creator = $sinBudget->creator;
      $bud->editor = $sinBudget->editor;
      $bud->year = $sinBudget->year;
      $bud->id = $sinBudget->id;
      $bud->availableBudget = ($bud->annual_budget - ($sinBudget->institutecomponentbudgets ? $sinBudget->institutecomponentbudgets->sum('annual_budget') : 0));
      $bud->disabled = ($bud->availableBudget < 1);
      return $bud;
    });
    return view('admin.budget.component.list', $data);
  }


  public function create() {
    $data['components'] = Component::select('id', 'name')->orderBy('name')->get();
    $data['fiscalyears'] = FiscalYear::select('id', 'code', 'start_date')->orderBy('start_date')->get();
    return view('admin.budget.component.create', $data);
  }


  public function manage($id = null) {
    if ($data['fcBudget'] = ComponentBudget::find($id)) {
      $data['components'] = Component::select('id', 'name')->orderBy('name')->get();
      $data['fiscalyears'] = FiscalYear::select('id', 'code', 'start_date')->orderBy('start_date')->get();
      return view('admin.budget.component.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.budget.component.list', '<strong>Sorry!!!</strong> Component Budget not found');
  }


  public function store(Request $request) {

    $message = '<strong>Congratulations!!!</strong> Component budget successfully ';
    $rules = [
      'component_id' => 'required',
      'fiscal_year_id' => 'required',
      'annual_budget' => 'required',
    ];

    if ($request->has('id')) {
      if (ComponentBudget::whereNot('id', $request->id)->where('component_id', $request->component_id)->where('fiscal_year_id', $request->fiscal_year_id)->first()) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Already has one with same component with fiscal year.');
      }
      $componentBudget = ComponentBudget::find($request->id);
      $message = $message . ' updated';
      $componentBudget->updated_by = \auth()->id();
    } else {
      if (ComponentBudget::where('component_id', $request->component_id)->where('fiscal_year_id', $request->fiscal_year_id)->first()) {
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Already has one with same component with fiscal year.');
      }
      $componentBudget = new ComponentBudget();
      $message = $message . ' created';
      $componentBudget->created_by = \auth()->id();
    }
    $request->validate($rules);
    try {
      $componentBudget->component_id = $request->component_id;
      $componentBudget->fiscal_year_id = $request->fiscal_year_id;
      $componentBudget->type = $request->type;
      $componentBudget->annual_budget = $request->annual_budget;

      $componentBudget->m1 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m1 : null;
      $componentBudget->m2 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m2 : null;
      $componentBudget->m3 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m3 : null;
      $componentBudget->m4 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m4 : null;
      $componentBudget->m5 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m5 : null;
      $componentBudget->m6 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m6 : null;
      $componentBudget->m7 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m7 : null;
      $componentBudget->m8 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m8 : null;
      $componentBudget->m9 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m9 : null;
      $componentBudget->m10 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m10 : null;
      $componentBudget->m11 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m11 : null;
      $componentBudget->m12 = ($componentBudget->type === ComponentBudget::$typeArrays[1]) ? $request->m12 : null;

      if ($componentBudget->type === ComponentBudget::$typeArrays[1]) {
        $month_budget = $request->m1 + $request->m2 + $request->m3 + $request->m4 + $request->m5 + $request->m6 + $request->m7 + $request->m8 + $request->m9 + $request->m10 + $request->m11 + $request->m12;
        if ($request->annual_budget != round($month_budget)) {
          return RedirectHelper::backWithInput('<strong>Sorry!!! </strong> Annual budget and total month is not match.');
        }
      }

      if ($componentBudget->save()) {
        return RedirectHelper::routeSuccess('admin.budget.component.list', $message);
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
