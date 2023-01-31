<?php

use App\Models\InstituteBuilding;
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
        Schema::create(with(new InstituteBuilding)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->string('building_name')->nullable();
            $table->string('block_name')->nullable();
            $table->string('floor_name')->nullable();
            $table->string('room_name')->nullable();
            $table->string('room_no')->nullable();
            $table->integer('sn')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists(with(new InstituteBuilding)->getTable());
    }
};
