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
        Schema::create('job_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->string('title');
            $table->string('place')->nullable();
            $table->string('start_date');
            $table->string('end_date');
//            $table->string('sponsors');
//            $table->string('partners');
//            $table->string('employers');
//            $table->string('job_type');
//            $table->string('post_type');
//            $table->string('perticipant_criteria');
            $table->string('guest_no')->nullable();
            $table->string('event_details')->nullable();
            $table->string('guest_details')->nullable();
            $table->string('image', 2048)->nullable();
          $table->string('status')->default(\App\Models\JobEvent::$statusArrays[0]);
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
        Schema::dropIfExists('job_events');
    }
};
