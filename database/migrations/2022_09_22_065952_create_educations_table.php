<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Education;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create(with(new Education())->getTable(), function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('exam_name')->nullable();
            $table->string('institute')->nullable();
            $table->string('board')->nullable();
            $table->string('department')->nullable();
            $table->string('year')->nullable();
            $table->string('status')->default(Education::$statusArrays[0]);
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
        Schema::dropIfExists(with(new Education())->getTable(),);
    }
};
