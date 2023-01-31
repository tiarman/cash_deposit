<?php

use App\Models\VoucherDetails;
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
        Schema::create(with(new VoucherDetails)->getTable(), function (Blueprint $table) {
//          id, voucher_id, component_id, sub_component_id, subsidiary_component_id, type(DR,CR), dr_amount, cr_amount,
//          created_by, updated_by, order(dr and cr same no), cheque_no,  cheque_date,  cheque_amount.
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('component_id');
            $table->unsignedBigInteger('sub_component_id');
            $table->unsignedBigInteger('subsidiary_component_id');
            $table->string('type')->nullable();
            $table->double('dr_amount')->nullable();
            $table->double('cr_amount')->nullable();
            $table->integer('order')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->double('cheque_amount')->nullable();
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
        Schema::dropIfExists(with(new VoucherDetails)->getTable());
    }
};
