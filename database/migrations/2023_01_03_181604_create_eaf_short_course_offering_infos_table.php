<?php

use App\Models\EafShortCourseOfferingInfo;
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
    Schema::create(with(new EafShortCourseOfferingInfo)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('form_id');
      $table->string('coi_course_title');
      $table->year('coi_year_of_initiated');
      $table->string('coi_course_duration');
      $table->double('coi_intake_capacity_per_cycle');
      $table->integer('coi_trained_trainee_in2021');
      $table->integer('coi_number_of_teacher');
      $table->string('coi_course_competency_based');
      $table->string('coi_adopted_framework');
      $table->string('coi_accredited_by');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EafShortCourseOfferingInfo)->getTable());
  }
};
