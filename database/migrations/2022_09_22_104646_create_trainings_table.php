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
        Schema::create(with(new Training)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('type_id');
            $table->string('title');
            $table->string('technology');
            $table->string('participation')->default('single');
            $table->integer('participant_limit')->nullable();
            $table->longText('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default(Training::$statusArrays[0]);
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
        Schema::dropIfExists(with(new Training)->getTable());
    }
};
