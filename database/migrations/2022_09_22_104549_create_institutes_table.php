<?php

use App\Models\Institute;
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
//        status(inactive,active)
        Schema::create(with(new Institute)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_head_id');
            $table->unsignedBigInteger('institute_type_id')->nullable();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->integer('code')->unique()->nullable();
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('photo')->nullable();
            $table->longText('address')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default(Institute::$statusArrays[0]);
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
        Schema::dropIfExists(with(new Institute)->getTable());
    }
};
