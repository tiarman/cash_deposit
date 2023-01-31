<?php

use App\Models\ComponentBudget;
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
    Schema::create(with(new ComponentBudget)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('component_id');
      $table->unsignedBigInteger('fiscal_year_id');
      $table->string('type')->default(ComponentBudget::$typeArrays[0]);
      $table->double('annual_budget');
      $table->double('cost')->default(0);
      $table->double('m1')->nullable();
      $table->double('m2')->nullable();
      $table->double('m3')->nullable();
      $table->double('m4')->nullable();
      $table->double('m5')->nullable();
      $table->double('m6')->nullable();
      $table->double('m7')->nullable();
      $table->double('m8')->nullable();
      $table->double('m9')->nullable();
      $table->double('m10')->nullable();
      $table->double('m11')->nullable();
      $table->double('m12')->nullable();
      $table->unsignedBigInteger('created_by');
      $table->unsignedBigInteger('updated_by')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new ComponentBudget)->getTable());
  }
};
