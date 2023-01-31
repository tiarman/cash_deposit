<?php

use App\Models\EafShortCourseAffordabilityCourse;
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
    Schema::create(with(new EafShortCourseAffordabilityCourse)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('form_id');
      $table->string('ayc_course_title');
      $table->string('ayc_course_duration');
      $table->double('ayc_course_fee_2019');
      $table->double('ayc_course_fee_2018');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EafShortCourseAffordabilityCourse)->getTable());
  }
};
