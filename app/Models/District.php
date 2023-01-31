<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
  use HasFactory;

  protected $table = 'districts';
  protected $fillable = [
    'division_id',
    'name',
    'name_bn',
    'url',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function division(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Division::class, 'id', 'division_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function upazilas(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Upazila::class, 'district_id', 'id');
  }
}
