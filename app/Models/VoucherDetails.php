<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDetails extends Model
{
    use HasFactory;
    protected $table = 'voucher_details';
    protected $fillable = [
      'voucher_id',
      'component_id',
      'sub_component_id',
      'subsidiary_component_id',
      'type',
      'dr_amount',
      'cr_amount',
      'order',
      'cheque_no',
      'cheque_date',
      'cheque_amount',
      'statue',
      'created_by',
      'updated_by',
    ];

  public static $statusArrays = ['pending', 'accepted', 'rejected'];

  public function subsidaryComponent() {
    return $this->belongsTo(SubsidiaryComponent::class, 'subsidiary_component_id');
  }

  public function subComponent() {
    return $this->belongsTo(SubComponent::class, 'sub_component_id');
  }

  public function component() {
    return $this->belongsTo(Component::class, 'component_id');
  }

    public function voucher() {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
