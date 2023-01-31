<?php

use App\Models\EafShortCourse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create(with(new EafShortCourse)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('applicant_id',);
      $table->unsignedBigInteger('institute_id',);
      $table->string('email',)->nullable();
      $table->string('institute_name_en',)->nullable();
      $table->string('institute_name_bn',)->nullable();
      $table->string('institute_code',)->nullable();
      $table->string('telephone',)->nullable();
      $table->string('institute_website',)->nullable();
      $table->string('institute_type',)->nullable();
      $table->string('institute_category',)->nullable();
      $table->unsignedBigInteger('division_id',);
      $table->unsignedBigInteger('district_id',);
      $table->unsignedBigInteger('upazila_id',);
      $table->string('principal_name',);
      $table->string('principal_phone',);
      $table->string('principal_email',);
      $table->year('years_of_institute_establishment');
      $table->integer('years_of_institute_establishment_score')->default(0);
      $table->integer('annual_intake');
      $table->integer('annual_intake_score')->default(0);
      $table->year('years_of_accredited_with_bteb');
      $table->integer('years_of_accredited_with_bteb_score')->default(0);
      $table->integer('trades_of_short_course_conducted_by_the_institute');
      $table->integer('trades_of_short_course_conducted_by_the_institute_score')->default(0);
      $table->double('completion_rate');
      $table->integer('completion_rate_score')->default(0);
      $table->integer('trade_wise_no_of_trainer_instructor');
      $table->integer('trade_wise_no_of_trainer_instructor_score')->default(0);
      $table->string('workshop_with_training_equipment_as_per_cs');
      $table->integer('workshop_with_training_equipment_as_per_cs_score')->default(0);
      $table->string('existence_of_job_placement_cell');
      $table->integer('existence_of_job_placement_cell_score')->default(0);
      $table->string('provision_of_occupational_health_safety');
      $table->integer('provision_of_occupational_health_safety_score')->default(0);
      $table->integer('existence_of_employment_track_record');
      $table->integer('existence_of_employment_track_record_score')->default(0);



      $table->integer('oi_enrolled_trainees_2019');
      $table->integer('oi_female_trainee_2019');
      $table->integer('oi_completed_trainee_2019');
      $table->double('oi_completed_percentage_2019');
      $table->integer('oi_enrolled_trainees_2018');
      $table->integer('oi_female_trainee_2018');
      $table->integer('oi_completed_trainee_2018');
      $table->double('oi_completed_percentage_2018');
      $table->integer('occupation_or_course_offered');
      $table->integer('total_number_of_teacher');
      $table->integer('total_number_of_non_tech_staff');
      $table->string('accreditation');
      $table->string('accreditation_agency')->nullable();
      $table->string('share_cash_kind');
      $table->integer('sbi_trainee_from_rural_area_2019');
      $table->integer('sbi_female_trainee_2019');
      $table->integer('sbi_trainee_with_disabilities_2019');
      $table->integer('sbi_trainee_of_ethnic_minority_2019');
      $table->integer('sbi_trainee_from_rural_area_2018');
      $table->integer('sbi_female_trainee_2018');
      $table->integer('sbi_trainee_with_disabilities_2018');
      $table->integer('sbi_trainee_of_ethnic_minority_2018');



      $table->string('status')->default('pending');
      $table->double('mark')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EafShortCourse)->getTable());
  }
};
