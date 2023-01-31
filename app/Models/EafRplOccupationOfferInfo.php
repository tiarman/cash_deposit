<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafRplOccupationOfferInfo extends Model
{
    use HasFactory;

    protected $table = 'eaf_rpl_occupation_offer_infos';
    protected $fillable = [
      'form_id',
      'ooi_occupation_title',
      'ooi_year_of_initiated',
      'ooi_occupation_duration',
      'ooi_intake_capacity_per_cycle',
      'ooi_trained_trainee_in2021',
      'ooi_number_of_teacher',
      'ooi_occupation_competency_based',
      'ooi_adopted_framework',
      'ooi_accredited_by',
    ];
}
