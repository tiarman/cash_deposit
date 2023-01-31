<?php

use App\Models\InstituteBuildingItem;
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
    Schema::create(with(new InstituteBuildingItem)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('institute_id');
      $table->unsignedBigInteger('institute_buildings_id');
      $table->string('name')->nullable();
      $table->integer('quantity')->nullable();
      $table->string('prefix')->nullable();
      $table->string('serial')->nullable();
      $table->string('accn_no')->nullable();
      $table->longText('remarks')->nullable();
      $table->string('status')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new InstituteBuildingItem)->getTable());
  }
};
