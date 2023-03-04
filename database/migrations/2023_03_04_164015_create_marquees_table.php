<?php

use App\Models\Marquee;
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
        Schema::create(with(new Marquee)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->longText('headline')->nullable();
            $table->string('status')->default(Marquee::$statusArrays[0]);
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
        Schema::dropIfExists(with(new Marquee)->getTable());
    }
};
