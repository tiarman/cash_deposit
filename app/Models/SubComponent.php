<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComponent extends Model {
  use HasFactory;

  protected $table = 'sub_components';
  protected $fillable = [
    'component_id',
    'name',
    'code',
    'created_by',
    'updated_by',
  ];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function subsidiaries(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(SubsidiaryComponent::class, 'sub_component_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function component(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Component::class, 'component_id');
  }

  public function creator() {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function editor() {
    return $this->belongsTo(User::class, 'updated_by');
  }

}
