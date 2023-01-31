<?php

use App\Models\EafRplOccupationOfferInfo;
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
    Schema::create(with(new EafRplOccupationOfferInfo)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('form_id');
      $table->string('ooi_occupation_title');
      $table->year('ooi_year_of_initiated');
      $table->string('ooi_occupation_duration');
      $table->integer('ooi_intake_capacity_per_cycle');
      $table->integer('ooi_trained_trainee_in2021');
      $table->integer('ooi_number_of_teacher');
      $table->string('ooi_occupation_competency_based');
      $table->string('ooi_adopted_framework');
      $table->string('ooi_accredited_by');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EafRplOccupationOfferInfo)->getTable());
  }
};
