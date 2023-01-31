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
        Schema::create('fiscal_periods', function (Blueprint $table) {
//            id, fiscal_year_id, start_date, end_date, month_name, quter_no(1,2,3 & 4), created_by, updated_by
            $table->id();
            $table->integer('fiscal_year_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('month_name');
            $table->integer('quarter_no');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiscal_periods');
    }
};
