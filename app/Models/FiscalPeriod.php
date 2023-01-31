<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalPeriod extends Model
{
    use HasFactory;
//id, fiscal_year_id, start_date, end_date, month_name, quter_no(1,2,3 & 4), created_by, updated_by
    protected $table = 'fiscal_periods';
    protected $fillable = [
        'fiscal_year_id',
        'start_date',
        'end_date',
        'month_name',
        'quarter_no',
        'created_by',
        'updated_by',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fiscalYear(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(FiscalYear::class, 'id', 'fiscal_id');
    }
    public static $quarterNo = [1, 2, 3, 4];

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function upazilas(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Upazila::class, 'district_id', 'id');
//    }
}

