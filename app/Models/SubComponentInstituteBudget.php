<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComponentInstituteBudget extends Model {
  use HasFactory;

  protected $table = 'sub_component_institute_budgets';

  protected $fillable = [
    'component_institute_budget_id',
    'institute_id',
    'fiscal_year_id',
    'sub_component_id',
    'type',
    'annual_budget',
    'org_proposed',
    'revised',
    'cost',
    'm1',
    'm2',
    'm3',
    'm4',
    'm5',
    'm6',
    'm7',
    'm8',
    'm9',
    'm10',
    'm11',
    'm12',
    'created_by',
    'updated_by'
  ];
  public static $typeArrays = ['yearly', 'monthly'];

  public function componentinstitutebudget() {
    return $this->belongsTo(ComponentInstituteBudget::class, 'component_institute_budget_id');
  }

  public function institute() {
    return $this->belongsTo(Institute::class, 'institute_id');
  }

  public function year() {
    return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
  }

  public function subcomponent() {
    return $this->belongsTo(SubComponent::class, 'sub_component_id');
  }

  public function creator() {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function editor() {
    return $this->belongsTo(User::class, 'updated_by');
  }
}
