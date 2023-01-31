<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentBudget extends Model
{
    use HasFactory;
    protected $table = 'component_budgets';

    protected $fillable = [
    'component_id',
    'fiscal_year_id',
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

    public function year(){
        return $this->belongsTo(FiscalYear::class,'fiscal_year_id');
    }
    public function component(){
        return $this->belongsTo(Component::class,'component_id');
    }
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function editor(){
        return $this->belongsTo(User::class,'updated_by');
    }
    public function institutecomponentbudgets(){
        return $this->hasMany(ComponentInstituteBudget::class,'component_budget_id', 'id');
    }
}
