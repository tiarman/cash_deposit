<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eaf_Rpl extends Model
{
    use HasFactory;
    protected $table = 'eaf__rpls';

    protected $fillable = [
        'years_of_institute_establishment',
        'condition_for_years_of_institute_establishment',
        'years_of_institute_establishment_score',
        'years_of_rto_registration',
        'condition_for_years_of_rto_registration',
        'years_of_rto_registration_score',
        'number_of_batch_conducted_rpl_by_the_institute',
        'condition_for_number_of_batch_conducted_rpl_by_the_institute',
        'number_of_batch_conducted_rpl_by_the_institute_score',
        'trade_wise_no_of_trainer_instructor_for_rpl_facilitation',
        'condition_for_trade_wise_no_of_trainer_instructor',
        'trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score',
        'number_of_occupations_of_rpl',
        'condition_for_number_of_occupations_of_rpl',
        'number_of_occupations_of_rpl_score',
        'level_ntvqf_of_rpl_assessment',
        'condition_for_level_ntvqf_of_rpl_assessment',
        'level_ntvqf_of_rpl_assessment_score',
        'total_number_of_rpl_assessment',
        'condition_for_total_number_of_rpl_assessment',
        'total_number_of_rpl_assessment_score',
        'total_number_of_rpl_certification',
        'condition_for_total_number_of_rpl_certification',
        'total_number_of_rpl_certification_score',
        'occupation_wise_number_of_rpl_assessor',
        'condition_for_occupation_wise_number_of_rpl_assessor',
        'occupation_wise_number_of_rpl_assessor_score',
        'number_of_rpl_workshop_with_list_of_equipments',
        'condition_for_number_of_rpl_workshop_with_list_of_equipments',
        'number_of_rpl_workshop_with_list_of_equipments_score',
        'boarding_and_lodging_facilities',
        'condition_for_boarding_and_lodging_facilities',
        'boarding_and_lodging_facilities_score',
        'rpl_awareness_activities',
        'condition_for_rpl_awareness_activities',
        'rpl_awareness_activities_score',
        'existence_of_job_placement_centre',
        'condition_for_existence_of_job_placement_centre',
        'existence_of_job_placement_centre_score',
        'existence_of_job_placement_centre_scoreexistence',
        'condition_for_existence_of_occupation_counselling',
        'existence_of_occupation_counselling_score',
        'existence_of_employment_track_record',
        'condition_for_existence_of_employment_track_record',
        'existence_of_employment_track_record_score',
        'linkage_with_industry',
        'condition_for_linkage_with_industry',
        'linkage_with_industry_score',
        'implementation_plan',
        'condition_for_implementation_plan',
        'implementation_plan_score',
        'investment_plan',
        'condition_for_investment_plan',
        'investment_plan_score',
        'environmental_and_social_management_plan',
        'condition_for_environmental_and_social_management_plan',
        'environmental_and_social_management_plan_score',
        'presence_of_occupational_health_and_safety',
        'condition_for_presence_of_occupational_health_and_safety',
        'presence_of_occupational_health_and_safety_score',
        'file',
    ];


}
