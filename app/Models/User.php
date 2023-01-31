<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use HasRoles;
  use TwoFactorAuthenticatable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'username',
    'marital_status',
    'blood_group',
    'trade_technology',
    'designation',
    'religion',
    'gender',
    'email',
    'phone',
    'name_en',
    'name_bn',
    'father_name',
    'mother_name',
    'nid',
    'dob',
    'alt_phone',
    'village',
    'ps',
    'po',
    'division_id',
    'district_id',
    'upazila_id',
    'institute_id',
    'password',
    'profile_photo_path',
    'status',
    'image',
    'address',
    'institute_type',
    'trade_technology_id',
    'shift_id',
    'section',
    // 'department',
    'semester_id',
    'year',
    'session',
    'board_roll',
    'running_board_roll',
    'admission_year',
    'birth_certificate',
    //evalutor
    'office',
    'employment_status',
    'employing_company',
    'cv',

  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];


  public static $minimumPasswordLength = 8;
  public static $statusArrays = ['inactive', 'active' ,'rejected'];

  public function institute(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Institute::class, 'id', 'institute_id');
  }


  public function division(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Division::class, 'id', 'division_id');
  }

  public function district(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(District::class, 'id', 'district_id');
  }

  public function upazila(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Upazila::class, 'id', 'upazila_id');
  }

  public function department(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Technology::class, 'id', 'department_id');
  }

  public static $genderArrays = ['male','female'];
  public static $religionArrays = ['islam','hindu'];
  public static $bloodArrays = ['a+', 'a-','b+','b-','o+','o-','ab+','ab-'];
  public static $maritalArrays = ['married', 'unmarried'];
  public static $yearArrays = ['first year', 'second year','third year','fourth year',];
  public static $employmentArrays = ['unemployed', 'employed', 'self employed'];
}
