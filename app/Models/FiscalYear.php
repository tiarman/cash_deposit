<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;

//id, code, start_date, end_date, created_by, updated_by, status(inactive, active)
    protected $table = 'fiscal_years';
    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
        'status',
    ];


    public function fiscalPeriods(){
        return $this->hasMany(FiscalPeriod::class,'fiscal_year_id');
    }



    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function editor(){
        return $this->belongsTo(User::class,'updated_by');
    }
    public static $statusArrayss = ['inactive', 'active'];
}
