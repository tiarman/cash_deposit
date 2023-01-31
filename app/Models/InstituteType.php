<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteType extends Model
{
    use HasFactory;
    protected $table = 'institute_types';
    protected $fillable = [
      'name',
      'created_by',
      'updated_by'
    ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'created_by');
  }
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'updated_by');
  }
}
