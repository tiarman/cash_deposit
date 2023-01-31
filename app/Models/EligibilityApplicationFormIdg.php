<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EligibilityApplicationFormIdg extends Model
{
  use HasFactory;

  protected $table = 'eligibility_application_form_idgs';
  protected $fillable = [
    'applicant_id',
    'institute_id',
    'email',
    'institute_name_en',
    'institute_name_bn',
    'institute_code',
    'telephone',
    'institute_website',
    'institute_type',
    'institute_category',
    'division_id',
    'district_id',
    'upazila_id',
    'principal_name',
    'principal_phone',
    'principal_email',
    'establishment_year',
    'score_for_establishment_year',
    'student_intake_capacity_2022',
    'student_intake_capacity_2021',
    'student_intake_capacity_2020',
    'student_intake_capacity_2019',
    'no_of_actual_student_2022',
    'no_of_actual_student_2021',
    'no_of_actual_student_2020',
    'no_of_actual_student_2019',
    'score_for_intake_criterion',
    'no_students_form_fill_up_2022',
    'no_students_form_fill_up_2021',
    'no_students_form_fill_up_2020',
    'no_students_form_fill_up_2019',
    'no_students_passed_2022',
    'no_students_passed_2021',
    'no_students_passed_2020',
    'no_students_passed_2019',
    'average_passed_students_last_3_year',
    'average_passed_rate_last_3_year',
    'score_of_students_passed_rates',
    'total_students_2022',
    'total_students_2021',
    'total_students_2020',
    'total_students_2019',
    'total_female_students_2022',
    'total_female_students_2021',
    'total_female_students_2020',
    'total_female_students_2019',
    'avg_student_of_last_3_year',
    'avg_female_student_of_last_3_year',
    'score_of_student_population',
    'score_of_female_student_population',
    'no_of_technology_or_trade_courses',
    'score_no_of_technology_or_trade_courses',
    'total_number_of_approved_teachers',
    'total_number_of_reguler_teachers',
    'total_number_of_contractual_teachers',
    'teacher_vacancy_ratio',
    'score_of_teacher_vacancy_ratio',
    'score_for_student_teacher_ratio',
    'premise_type',
    'score_for_infrastructure',
    'external_audit_performed_2022',
    'external_audit_performed_2021',
    'external_audit_performed_2020',
    'external_audit_performed_2019',
    'opinions_of_external_audit_2022',
    'opinions_of_external_audit_2021',
    'opinions_of_external_audit_2020',
    'opinions_of_external_audit_2019',
    'score_of_audit',
    'institute_have_own_land',
    'amount_of_total_land',
    'price_of_land',
    'date_of_purchase_or_ownership',
    'location_of_land',
    'institute_accreditation_from_competent_authority',
    'have_you_receive_idg_from_step',
    'idg_amount_awarded_from_step',
    'idg_amount_utilized_under_step',
    'has_objections_or_lawsuit',
    'idg_received_from_any_other_gob_project_or_budget',
    'name_of_the_project',
    'year_of_financing',
    'duration_of_financing',
    'amount_received',
    'outcomes',
    'institute_have_rto',
    'self_finance_at_least_15_of_the_cash',
    'status',
    'mark',
  ];


  public static $boolTypes = [['name' => 'Yes','id' => 1],['name' => 'No','id' => 0]];
  public static $boolTypesName = ['No', 'Yes'];
//  public static $externalAuditTypes = [['name' => 'Satisfactory','id' => 1],['name' => 'Unsatisfactory','id' => 0]];
  public static $externalAuditTypes = [['name' => 'Yes','id' => 1],['name' => 'No','id' => 0]];
//  public static $externalAuditTypesName = ['Unsatisfactory', 'Satisfactory'];
  public static $externalAuditTypesName = ['No', 'Yes'];
  public static $premiseTypes = ['Own premises', 'Partly owned premises', 'Rented premises'];
  public static $instituteTypes = [
    'Govt. Polytechnic Institute',
    'Private Polytechnic Institute',
    'Govt. Technical School and College',
    'Institutes of Marine Technology (IMT)',
    'Institute of Health Technology (IHT)',
    'Medical Assistant Training School (MATS)',
    'Nursing College/Institute (Diploma-level)'
  ];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function division(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Division::class, 'division_id');
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
  public function institute(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Institute::class, 'institute_id');
  }


  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function applicant(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'applicant_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function files(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(EligibilityApplicationFormIdgFile::class, 'form_id', 'id');
  }
}
