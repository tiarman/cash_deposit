<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafShortCourse extends Model
{
    use HasFactory;
  protected $table = 'eaf_short_courses';

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
    'years_of_institute_establishment',
    'years_of_institute_establishment_score',
    'annual_intake',
    'annual_intake_score',
    'years_of_accredited_with_bteb',
    'years_of_accredited_with_bteb_score',
    'trades_of_short_course_conducted_by_the_institute',
    'trades_of_short_course_conducted_by_the_institute_score',
    'completion_rate',
    'completion_rate_score',
    'share_cash_kind',
    'trade_wise_no_of_trainer_instructor',
    'trade_wise_no_of_trainer_instructor_score',
    'workshop_with_training_equipment_as_per_cs',
    'workshop_with_training_equipment_as_per_cs_score',
    'existence_of_job_placement_cell',
    'existence_of_job_placement_cell_score',
    'provision_of_occupational_health_safety',
    'provision_of_occupational_health_safety_score',
    'existence_of_employment_track_record',
    'existence_of_employment_track_record_score',
    'oi_enrolled_trainees_2019',
    'oi_female_trainee_2019',
    'oi_completed_trainee_2019',
    'oi_completed_percentage_2019',
    'oi_enrolled_trainees_2018',
    'oi_female_trainee_2018',
    'oi_completed_trainee_2018',
    'oi_completed_percentage_2018',
    'occupation_or_course_offered',
    'total_number_of_teacher',
    'total_number_of_non_tech_staff',
    'accreditation',
    'accreditation_agency',
    'sbi_trainee_from_rural_area_2019',
    'sbi_female_trainee_2019',
    'sbi_trainee_with_disabilities_2019',
    'sbi_trainee_of_ethnic_minority_2019',
    'sbi_trainee_from_rural_area_2018',
    'sbi_female_trainee_2018',
    'sbi_trainee_with_disabilities_2018',
    'sbi_trainee_of_ethnic_minority_2018',

    'status',
    'mark',
  ];

  public static $instituteTypes = [
    'Govt. Polytechnic Institute',
    'Private Polytechnic Institute',
    'Govt. Technical School and College',
    'Institutes of Marine Technology (IMT)',
    'Institute of Health Technology (IHT)',
    'Medical Assistant Training School (MATS)',
    'Nursing College/Institute (Diploma-level)',
    'Technical Training Center',
    'Private Short Course Providers',
    'Registered Training Organization',
    'RPL & Short Course Providers',
    'Training Providers',
    'Others'
  ];

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
    return $this->hasMany(EafShortCourseFile::class, 'form_id', 'id');
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
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function aycs(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(EafShortCourseAffordabilityCourse::class, 'form_id');
  }


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function cois(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(EafShortCourseOfferingInfo::class, 'form_id', 'id');
  }

}
