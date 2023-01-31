<?php

use App\Models\ProjectIdea;
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
//        project_id, title, keyword, short_description, description,
//        benefits, implementation_location, expenses, instrument_details,
//        status(save, pending, accepted, rejected),
//        hod_approval, vp_approval, p_approval, pmu_approval,
        Schema::create(with(new ProjectIdea)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->longText('keyword')->nullable();
            $table->longText('short_description');
            $table->longText('short_description_bn')->nullable();
            $table->longText('description');
            $table->longText('description_bn')->nullable();
            $table->longText('benefits');
            $table->longText('implementation_location');
            $table->double('expenses');
            $table->longText('instrument_details');
            $table->string('status');
            $table->unsignedBigInteger('hod_approval_id')->nullable();
            $table->string('hod_approval')->nullable();
            $table->unsignedBigInteger('vp_approval_id')->nullable();
            $table->string('vp_approval')->nullable();
            $table->unsignedBigInteger('p_approval_id')->nullable();
            $table->string('p_approval')->nullable();
            $table->unsignedBigInteger('pmu_approval_id')->nullable();
            $table->string('pmu_approval')->nullable();
            $table->year('year');
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
        Schema::dropIfExists(with(new ProjectIdea)->getTable());
    }
};
