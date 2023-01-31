<?php

use App\Models\jobFairHasParticipant;
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
        Schema::create('job_fair_has_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_event_id');
            $table->unsignedBigInteger('participant_id');
            $table->string('status');
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
        Schema::dropIfExists('job_fair_has_participants');
    }
};
