<?php

use App\Models\EafRplWithoutScore;
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
    Schema::create(with(new EafRplWithoutScore)->getTable(), function (Blueprint $table) {
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

      $table->integer('total_enrolled_trainee_2021')->default(0);
      $table->integer('female_trainee_2021')->default(0);
      $table->integer('total_trainee_completed_2021')->default(0);
      $table->double('percentage_completed_trainee_2021')->default(0);
      $table->integer('total_enrolled_trainee_2020')->default(0);
      $table->integer('female_trainee_2020')->default(0);
      $table->integer('total_trainee_completed_2020')->default(0);
      $table->double('percentage_completed_trainee_2020')->default(0);
      $table->integer('total_enrolled_trainee_2019')->default(0);
      $table->integer('female_trainee_2019')->default(0);
      $table->integer('total_trainee_completed_2019')->default(0);
      $table->double('percentage_completed_trainee_2019')->default(0);
      $table->integer('total_occupation_offered')->default(0);
      $table->integer('total_number_of_teacher')->default(0);
      $table->integer('total_no_of_non_tech_staff')->default(0);
      $table->string('accreditation');

      $table->integer('sbi_trainee_from_rural_area_2021')->default(0);
      $table->integer('sbi_female_trainee_2021')->default(0);
      $table->integer('sbi_trainee_with_disabilities_2021')->default(0);
      $table->integer('sbi_trainee_of_ethnic_minority_2021')->default(0);
      $table->integer('sbi_trainee_from_rural_area_2020')->default(0);
      $table->integer('sbi_female_trainee_2020')->default(0);
      $table->integer('sbi_trainee_with_disabilities_2020')->default(0);
      $table->integer('sbi_trainee_of_ethnic_minority_2020')->default(0);
      $table->integer('sbi_trainee_from_rural_area_2019')->default(0);
      $table->integer('sbi_female_trainee_2019')->default(0);
      $table->integer('sbi_trainee_with_disabilities_2019')->default(0);
      $table->integer('sbi_trainee_of_ethnic_minority_2019')->default(0);
      $table->string('status')->default('pending');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EafRplWithoutScore)->getTable());
  }
};
