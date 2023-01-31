<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafShortCourseOfferingInfo extends Model
{
    use HasFactory;

    protected $table = 'eaf_short_course_offering_infos';
    protected $fillable = [
      'form_id',
      'coi_course_title',
      'coi_year_of_initiated',
      'coi_course_duration',
      'coi_intake_capacity_per_cycle',
      'coi_trained_trainee_in2021',
      'coi_number_of_teacher',
      'coi_course_competency_based',
      'coi_adopted_framework',
      'coi_accredited_by',
    ];
}
