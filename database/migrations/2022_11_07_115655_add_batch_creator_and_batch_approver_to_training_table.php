<?php

use App\Models\Training;
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
        Schema::table(with(new Training)->getTable(), function (Blueprint $table) {
            $table->unsignedBigInteger('batch_creator_id')->nullable();
            $table->unsignedBigInteger('batch_approver_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(with(new Training)->getTable(), function (Blueprint $table) {
            $table->dropColumn('batch_creator_id');
            $table->dropColumn('batch_approver_id');
        });
    }
};
