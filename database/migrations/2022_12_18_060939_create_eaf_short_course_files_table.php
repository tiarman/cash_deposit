<?php

use App\Models\EafShortCourseFile;
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
        Schema::create(with(new EafShortCourseFile())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists(with(new EafShortCourseFile())->getTable());
    }
};
