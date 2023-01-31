<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafShortCourseAffordabilityCourse extends Model {
  use HasFactory;

  protected $table = 'eaf_short_course_affordability_courses';
  protected $fillable = [
    'form_id',
    'ayc_course_title',
    'ayc_course_duration',
    'ayc_course_fee_2019',
    'ayc_course_fee_2018',
  ];
}
