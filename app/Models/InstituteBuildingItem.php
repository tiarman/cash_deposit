<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteBuildingItem extends Model
{
    use HasFactory;
    protected $table = 'institute_building_items';

    protected $fillable = [
      'institute_id',
      'institute_buildings_id',
      'name',
      'quantity',
      'prefix',
      'serial',
      'accn_no',
      'remarks',
      'status',
    ];

  public static array $statusArrays = ['inactive', 'active', 'damaged'];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function institute(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Institute::class, 'institute_id');
  }


  /**+
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(InstituteBuilding::class, 'institute_buildings_id');
  }

}
