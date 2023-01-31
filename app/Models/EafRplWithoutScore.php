<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafRplWithoutScore extends Model
{
    use HasFactory;

    protected $table = 'eaf_rpl_without_scores';
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

      'total_enrolled_trainee_2021',
      'female_trainee_2021',
      'total_trainee_completed_2021',
      'percentage_completed_trainee_2021',
      'total_enrolled_trainee_2020',
      'female_trainee_2020',
      'total_trainee_completed_2020',
      'percentage_completed_trainee_2020',
      'total_enrolled_trainee_2019',
      'female_trainee_2019',
      'total_trainee_completed_2019',
      'percentage_completed_trainee_2019',
      'total_occupation_offered',
      'total_number_of_teacher',
      'total_no_of_non_tech_staff',
      'accreditation',

      'sbi_trainee_from_rural_area_2021',
      'sbi_female_trainee_2021',
      'sbi_trainee_with_disabilities_2021',
      'sbi_trainee_of_ethnic_minority_2021',
      'sbi_trainee_from_rural_area_2020',
      'sbi_female_trainee_2020',
      'sbi_trainee_with_disabilities_2020',
      'sbi_trainee_of_ethnic_minority_2020',
      'sbi_trainee_from_rural_area_2019',
      'sbi_female_trainee_2019',
      'sbi_trainee_with_disabilities_2019',
      'sbi_trainee_of_ethnic_minority_2019',
      'status',
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
    return $this->hasMany(EafRplWithoutScoreFile::class, 'form_id', 'id');
  }
  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ayos(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(EafRplAffordabilityOccupation::class, 'form_id');
  }


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function oois(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(EafRplOccupationOfferInfo::class, 'form_id', 'id');
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
}
