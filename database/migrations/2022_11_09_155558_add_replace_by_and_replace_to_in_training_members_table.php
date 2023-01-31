<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(with(new \App\Models\TrainingMember)->getTable(), function (Blueprint $table) {
          $table->unsignedBigInteger('replace_by')->nullable();
          $table->unsignedBigInteger('replace_from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(with(new \App\Models\TrainingMember)->getTable(), function (Blueprint $table) {
          $table->dropColumn('replace_by');
          $table->dropColumn('replace_from');
        });
    }
};
