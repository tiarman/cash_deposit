<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  use HasFactory;

  protected $table = 'divisions';
  protected $fillable = [
    'name', 'name_bn', 'url'
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function districts(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(District::class, 'division_id', 'id');
  }
}
