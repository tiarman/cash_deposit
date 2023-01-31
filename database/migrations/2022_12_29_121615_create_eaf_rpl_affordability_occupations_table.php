<?php

use App\Models\EafRplAffordabilityOccupation;
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
    Schema::create(with(new EafRplAffordabilityOccupation)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('form_id');
      $table->string('ayo_occupation_title');
      $table->string('ayo_occupation_duration');
      $table->double('ayo_occupation_fee_2019');
      $table->double('ayo_occupation_fee_2020');
      $table->double('ayo_occupation_fee_2021');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new EafRplAffordabilityOccupation)->getTable());
  }
};
