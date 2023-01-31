<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model {
  use HasFactory;


  protected $table = 'institutes';

  public function instituteHead() {
    return $this->belongsTo(User::class, 'institute_head_id');
  }


  protected $fillable = [
    'institute_head_id',
    'division_id',
    'district_id',
    'upazila_id',
    'institute_type_id',
    'code',
    'name',
    'name_bn',
    'phone',
    'email',
    'website',
    'photo',
    'address',
    'description',
    'status',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function members(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(User::class, 'institute_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function trainings(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(Training::class, 'institute_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function division(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Division::class, 'division_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(InstituteType::class, 'institute_type_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(District::class, 'district_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function upazila(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Upazila::class, 'upazila_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function idg(): \Illuminate\Database\Eloquent\Relations\HasOne {
    return $this->hasOne(EligibilityApplicationFormIdg::class, 'institute_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function rpl(): \Illuminate\Database\Eloquent\Relations\HasOne {
    return $this->hasOne(EafRplWithoutScore::class, 'institute_id', 'id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function sc(): \Illuminate\Database\Eloquent\Relations\HasOne {
    return $this->hasOne(EafShortCourse::class, 'institute_id', 'id');
  }


  public static $statusArrays = ['inactive', 'active'];
  public static $typeArrays = ['Regular', 'Training Provider' ];
}
