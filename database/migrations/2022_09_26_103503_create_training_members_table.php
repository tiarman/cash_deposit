<?php

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
    Schema::create(with(new \App\Models\TrainingMember)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('training_id');
      $table->string('name');
      $table->string('phone')->nullable();
      $table->unsignedBigInteger('batch_id')->nullable();
      $table->string('email')->nullable();
      $table->unsignedBigInteger('institute_head_id')->nullable();
      $table->dateTime('institute_head_approve_at')->nullable();
      $table->string('institute_head_approve_status')->nullable();
      $table->unsignedBigInteger('batch_creator_id')->nullable();
      $table->dateTime('batch_creator_approve_at')->nullable();
      $table->string('batch_creator_approve_status')->nullable();
      $table->unsignedBigInteger('batch_approver_id')->nullable();
      $table->dateTime('batch_approver_approve_at')->nullable();
      $table->string('batch_approver_approve_status')->nullable();
      $table->string('status')->default(\App\Models\TrainingMember::$statusArrays[0]);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists(with(new \App\Models\TrainingMember)->getTable());
  }
};
