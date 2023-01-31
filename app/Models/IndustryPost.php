<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryPost extends Model
{
  use HasFactory;
  protected $fillable = [
    'job_event_id',
    'industry_id',
    'job_title',
    'position',
    'vacancy',
    'location',
    'job_context',
    'educational_requirement',
    'additional_requirement',
    'job_responsibility',
    'compensation',
    'salary',
    'experience_requirement',
    'application_deadline',
    'employment_status',
    'ntvqf_level',
    'status',

  ];
  public static $statusArrays = ['inactive', 'active'];
  public static $ntvqf_level = ['level1', 'level2'];
  public static $employment_status = ['fulltime', 'halftime'];

  public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(User::class, 'id', 'industry_id');
  }
  public function job_event(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(User::class, 'id', 'job_event_id');
  }
}