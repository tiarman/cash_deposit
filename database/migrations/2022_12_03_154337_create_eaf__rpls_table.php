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
        Schema::create('eaf__rpls', function (Blueprint $table) {
            $table->id();
            $table->string('years_of_institute_establishment')->nullable();
            $table->string('condition_for_years_of_institute_establishment')->nullable();
            $table->string('years_of_institute_establishment_score')->nullable();
            $table->string('years_of_rto_registration')->nullable();
            $table->string('condition_for_years_of_rto_registration')->nullable();
            $table->string('years_of_rto_registration_score')->nullable();
            $table->string('number_of_batch_conducted_rpl_by_the_institute')->nullable();
            $table->string('condition_for_number_of_batch_conducted_rpl_by_the_institute')->nullable();
            $table->string('number_of_batch_conducted_rpl_by_the_institute_score')->nullable();
            $table->string('trade_wise_no_of_trainer_instructor_for_rpl_facilitation')->nullable();
            $table->string('condition_for_trade_wise_no_of_trainer_instructor')->nullable();
            $table->string('trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score')->nullable();
            $table->string('number_of_occupations_of_rpl')->nullable();
            $table->string('condition_for_number_of_occupations_of_rpl')->nullable();
            $table->string('number_of_occupations_of_rpl_score')->nullable();
            $table->string('level_ntvqf_of_rpl_assessment')->nullable();
            $table->string('condition_for_level_ntvqf_of_rpl_assessment')->nullable();
            $table->string('level_ntvqf_of_rpl_assessment_score')->nullable();
            $table->string('total_number_of_rpl_assessment')->nullable();
            $table->string('condition_for_total_number_of_rpl_assessment')->nullable();
            $table->string('total_number_of_rpl_assessment_score')->nullable();
            $table->string('total_number_of_rpl_certification')->nullable();
            $table->string('condition_for_total_number_of_rpl_certification')->nullable();
            $table->string('total_number_of_rpl_certification_score')->nullable();
            $table->string('occupation_wise_number_of_rpl_assessor')->nullable();
            $table->string('condition_for_occupation_wise_number_of_rpl_assessor')->nullable();
            $table->string('occupation_wise_number_of_rpl_assessor_score')->nullable();
            $table->string('number_of_rpl_workshop_with_list_of_equipments')->nullable();
            $table->string('condition_for_number_of_rpl_workshop_with_list_of_equipments')->nullable();
            $table->string('number_of_rpl_workshop_with_list_of_equipments_score')->nullable();
            $table->string('boarding_and_lodging_facilities')->nullable();
            $table->string('condition_for_boarding_and_lodging_facilities')->nullable();
            $table->string('boarding_and_lodging_facilities_score')->nullable();
            $table->string('rpl_awareness_activities')->nullable();
            $table->string('condition_for_rpl_awareness_activities')->nullable();
            $table->string('rpl_awareness_activities_score')->nullable();
            $table->string('existence_of_job_placement_centre')->nullable();
            $table->string('condition_for_existence_of_job_placement_centre')->nullable();
            $table->string('existence_of_job_placement_centre_score')->nullable();
            $table->string('existence_of_occupation_counselling')->nullable();
            $table->string('condition_for_existence_of_occupation_counselling')->nullable();
            $table->string('existence_of_occupation_counselling_score')->nullable();
            $table->string('existence_of_employment_track_record')->nullable();
            $table->string('condition_for_existence_of_employment_track_record')->nullable();
            $table->string('existence_of_employment_track_record_score')->nullable();
            $table->string('linkage_with_industry')->nullable();
            $table->string('condition_for_linkage_with_industry')->nullable();
            $table->string('linkage_with_industry_score')->nullable();
            $table->string('implementation_plan')->nullable();
            $table->string('condition_for_implementation_plan')->nullable();
            $table->string('implementation_plan_score')->nullable();
            $table->string('investment_plan')->nullable();
            $table->string('condition_for_investment_plan')->nullable();
            $table->string('investment_plan_score')->nullable();
            $table->string('environmental_and_social_management_plan')->nullable();
            $table->string('condition_for_environmental_and_social_management_plan')->nullable();
            $table->string('environmental_and_social_management_plan_score')->nullable();
            $table->string('presence_of_occupational_health_and_safety')->nullable();
            $table->string('condition_for_presence_of_occupational_health_and_safety')->nullable();
            $table->string('presence_of_occupational_health_and_safety_score')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('eaf__rpls');
    }
};
