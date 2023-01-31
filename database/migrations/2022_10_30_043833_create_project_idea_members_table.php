<?php

use App\Models\ProjectIdeaMember;
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
        Schema::create(with(new ProjectIdeaMember)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_idea_id');
            $table->bigInteger('user_id');
            $table->string('type')->nullable();
            $table->string('technology')->nullable();
            $table->string('semester')->nullable();
            $table->string('board_roll')->nullable();
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
        Schema::dropIfExists(with(new ProjectIdeaMember)->getTable());
    }
};
