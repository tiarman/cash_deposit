<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentInstituteBudget extends Model {
  use HasFactory;

  protected $table = 'component_institute_budgets';

  protected $fillable = [
    'component_budget_id',
    'institute_id',
    'fiscal_year_id',
    'component_id',
    'type',
    'annual_budget',
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

  public function componentbudget() {
    return $this->belongsTo(ComponentBudget::class, 'component_budget_id');
  }

  public function year() {
    return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
  }

  public function component() {
    return $this->belongsTo(Component::class, 'component_id');
  }

  public function institute() {
    return $this->belongsTo(Institute::class, 'institute_id');
  }

  public function creator() {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function editor() {
    return $this->belongsTo(User::class, 'updated_by');
  }

  public function institutesubcomponentbudgets(){
    return $this->hasMany(SubComponentInstituteBudget::class,'component_institute_budget_id', 'id');
  }
}
