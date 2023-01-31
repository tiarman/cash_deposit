<?php

use App\Models\EligibilityApplicationFormIdg;
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
    Schema::create(with(new EligibilityApplicationFormIdg)->getTable(), function (Blueprint $table) {
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
      $table->year('establishment_year',);
      $table->double('score_for_establishment_year',)->default(0);
      $table->integer('student_intake_capacity_2022',)->nullable();
      $table->integer('student_intake_capacity_2021',)->nullable();
      $table->integer('student_intake_capacity_2020',)->nullable();
      $table->integer('student_intake_capacity_2019',)->nullable();
      $table->integer('no_of_actual_student_2022',)->nullable();
      $table->integer('no_of_actual_student_2021',)->nullable();
      $table->integer('no_of_actual_student_2020',)->nullable();
      $table->integer('no_of_actual_student_2019',)->nullable();
      $table->double('score_for_intake_criterion',)->default(0);
      $table->integer('no_students_form_fill_up_2022',)->nullable();
      $table->integer('no_students_form_fill_up_2021',)->nullable();
      $table->integer('no_students_form_fill_up_2020',)->nullable();
      $table->integer('no_students_form_fill_up_2019',)->nullable();
      $table->integer('no_students_passed_2022',)->nullable();
      $table->integer('no_students_passed_2021',)->nullable();
      $table->integer('no_students_passed_2020',)->nullable();
      $table->integer('no_students_passed_2019',)->nullable();
      $table->double('average_passed_students_last_3_year',)->default(0);
      $table->double('average_passed_rate_last_3_year',)->default(0);
      $table->double('score_of_students_passed_rates',)->default(0);
      $table->integer('total_students_2022',)->nullable();
      $table->integer('total_students_2021',)->nullable();
      $table->integer('total_students_2020',)->nullable();
      $table->integer('total_students_2019',)->nullable();
      $table->integer('total_female_students_2022',)->nullable();
      $table->integer('total_female_students_2021',)->nullable();
      $table->integer('total_female_students_2020',)->nullable();
      $table->integer('total_female_students_2019',)->nullable();
      $table->double('avg_student_of_last_3_year',)->default(0);
      $table->double('avg_female_student_of_last_3_year',)->default(0);
      $table->double('score_of_student_population',)->default(0);
      $table->double('score_of_female_student_population',)->default(0);
      $table->integer('no_of_technology_or_trade_courses',);
      $table->double('score_no_of_technology_or_trade_courses',)->default(0);
      $table->integer('total_number_of_approved_teachers',);
      $table->integer('total_number_of_reguler_teachers',);
      $table->integer('total_number_of_contractual_teachers',);
      $table->double('teacher_vacancy_ratio',)->default(0);
      $table->double('score_of_teacher_vacancy_ratio',)->default(0);
      $table->double('score_for_student_teacher_ratio',)->default(0);
      $table->string('premise_type',);
      $table->string('score_for_infrastructure',);
      $table->tinyInteger('external_audit_performed_2022',)->nullable();
      $table->tinyInteger('external_audit_performed_2021',)->nullable();
      $table->tinyInteger('external_audit_performed_2020',)->nullable();
      $table->tinyInteger('external_audit_performed_2019',)->nullable();
      $table->tinyInteger('opinions_of_external_audit_2022',)->nullable();
      $table->tinyInteger('opinions_of_external_audit_2021',)->nullable();
      $table->tinyInteger('opinions_of_external_audit_2020',)->nullable();
      $table->tinyInteger('opinions_of_external_audit_2019',)->nullable();
      $table->double('score_of_audit',)->default(0);
      $table->boolean('institute_have_own_land')->default(false);
      $table->string('amount_of_total_land',)->nullable();
      $table->double('price_of_land',)->nullable();
      $table->date('date_of_purchase_or_ownership',)->nullable();
      $table->text('location_of_land',)->nullable();

      $table->tinyInteger('institute_accreditation_from_competent_authority',);
      $table->tinyInteger('have_you_receive_idg_from_step',);
      $table->double('idg_amount_awarded_from_step',)->default(0);
      $table->double('idg_amount_utilized_under_step',)->default(0);
      $table->tinyInteger('has_objections_or_lawsuit',)->nullable(0);
      $table->tinyInteger('idg_received_from_any_other_gob_project_or_budget',)->nullable();
      $table->string('name_of_the_project',)->nullable();
      $table->year('year_of_financing',)->nullable();
      $table->string('duration_of_financing',)->nullable();
      $table->double('amount_received',)->nullable();
      $table->longText('outcomes',)->nullable();
      $table->tinyInteger('institute_have_rto',);
      $table->string('self_finance_at_least_15_of_the_cash')->nullable();

      $table->string('status',)->default('pending');
      $table->double('mark',)->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EligibilityApplicationFormIdg)->getTable());
  }
};
