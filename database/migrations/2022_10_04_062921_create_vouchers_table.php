<?php

use App\Models\Voucher;
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
        Schema::create(with(new Voucher)->getTable(), function (Blueprint $table) {
//          id, institute_id, fiscal_year_id, type(DR,CR),narration, amount, created_by, updated_by
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('voucher_type_id');
            $table->unsignedBigInteger('fiscal_year_id');
            $table->unsignedBigInteger('fiscal_period_id');
            $table->integer('quarter')->default(1);
            $table->string('no')->nullable();
            $table->double('amount')->nullable();
            $table->longText('narration')->nullable();
            $table->string('statue')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists(with(new Voucher)->getTable());
    }
};
