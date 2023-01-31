<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;

//id, code, start_date, end_date, created_by, updated_by, status(inactive, active)
    protected $table = 'voucher_types';
    protected $fillable = [
        'id',
        'short_name',
        'name',
    ];


//    public function voucherEntries(){
//        return $this->hasMany(VoucherEntry::class,'voucher_id');
//    }


//
//    public function creator(){
//        return $this->belongsTo(User::class,'created_by');
//    }
//
//    public function editor(){
//        return $this->belongsTo(User::class,'updated_by');
//    }
//    public static $statusArrayss = ['inactive', 'active'];
}
