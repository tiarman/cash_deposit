<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model {
  use HasFactory;

  protected $table = 'vouchers';
  protected $fillable = [
    'institute_id',
    'fiscal_year_id',
    'voucher_type_id',
    'fiscal_period_id',
    'quarter',
    'no',
    'amount',
    'narration',
    'statue',
    'created_by',
    'updated_by',
  ];

  public static $statusArrays = ['pending', 'accepted', 'rejected'];


  public function creator() {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function editor() {
    return $this->belongsTo(User::class, 'updated_by');
  }

  public function institute() {
    return $this->belongsTo(Institute::class, 'institute_id');
  }

  public function period() {
    return $this->belongsTo(FiscalPeriod::class, 'fiscal_period_id');
  }

  public function year() {
    return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
  }

  public function type() {
    return $this->belongsTo(VoucherType::class, 'voucher_type_id');
  }

  public function details() {
    return $this->hasMany(VoucherDetails::class, 'voucher_id', 'id');
  }
}
