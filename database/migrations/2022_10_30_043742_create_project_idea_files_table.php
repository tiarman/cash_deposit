<?php

use App\Models\ProjectIdeaFile;
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
        Schema::create(with(new ProjectIdeaFile)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_idea_id');
            $table->string('type');
            $table->string('name');
            $table->string('size');
            $table->string('description');
            $table->string('file');
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
        Schema::dropIfExists(with(new ProjectIdeaFile)->getTable());
    }
};
