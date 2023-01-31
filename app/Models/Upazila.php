<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
  use HasFactory;

  protected $table = 'upazilas';
  protected $fillable = [
    'district_id',
    'name',
    'name_bn',
    'url',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function district(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(District::class, 'id', 'district_id');
  }
}
