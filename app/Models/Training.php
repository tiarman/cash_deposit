<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model {
  use HasFactory;

  protected $table = 'trainings';

  protected $fillable = [
    'user_id',
    'institute_id',
    'type',
    'title',
    'technology',
    'participation',
    'participant_limit',
    'description',
    'district_id',
    'division_id',
    'country_id',
    'start_date',
    'end_date',
    'status',
    'batch_creator_id',
    'batch_approver_id',
  ];


  public function participants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
    return $this->belongsToMany(InstituteType::class, with(new TrainingParticipant)->getTable(), 'training_id', 'institute_type_id');
  }

  public function institute(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Institute::class, 'institute_id');
  }

  public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Country::class, 'country_id');
  }

  public function division(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Division::class, 'division_id');
  }

  public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(District::class, 'district_id');
  }


  public function members(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(TrainingMember::class, 'training_id', 'id');
  }

  public function members_count(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(TrainingMember::class, 'training_id', 'id')->where('status', 'active');
  }


  public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function batchcreator(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'batch_creator_id');
  }

  public function batchapprover(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'batch_approver_id');
  }

  public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(TrainingType::class, 'type_id');
  }

  public function training_file() {
    return $this->hasOne(TrainingFile::class, 'id', 'training_file_id');
  }


  public static $typeArrays = ['local', 'foreign'];
  public static $participationArrays = ['single', 'multiple'];
  public static $statusArrays = ['pending', 'accept', 'rejected', 'completed'];
}
