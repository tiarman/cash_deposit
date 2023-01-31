<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostHasStudent extends Model
{
  public $timestamps = false;
  protected $fillable = [
    'post_id',
    'student_id',
    'status',
  ];

  public function post(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(IndustryPost::class, 'id', 'post_id');
  }
  public function graduate(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(User::class, 'id', 'student_id');
  }

  public static $statusArrays = ['waiting','shortlisted','rejected'];
}