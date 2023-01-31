<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteBuilding extends Model
{
    use HasFactory;
    protected $table = 'institute_buildings';
    protected $fillable = [
      'institute_id',
      'building_name',
      'block_name',
      'floor_name',
      'room_name',
      'room_no',
      'sn',
//      'name_of_item',
//      'quantity',
//      'accn_no',
//      'remarks',
      'status',
    ];

    public static array $statusArrays = ['inactive', 'active'];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function institute(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Institute::class, 'institute_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function items(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(InstituteBuildingItem::class, 'institute_buildings_id', 'id');
  }
}
