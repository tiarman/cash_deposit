<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobEvent extends Model
{
  use HasFactory;
  protected $fillable = [
    'title',
    'organizer_id',
    'place',
    'start_date',
    'end_date',
    'guest_no',
    'event_details',
    'guest_details',
    'status',
    'image',

  ];
  public static $statusArrays = ['inactive', 'active'];

  public function institute(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Institute::class, 'id', 'organizer_id');
  }
  public function jobFairHasParticipant(){
    return $this->hasMany(jobFairHasParticipant::class,'job_event_id','id');
  }
}
