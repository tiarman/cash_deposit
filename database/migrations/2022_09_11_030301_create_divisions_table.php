<?php

use App\Models\Division;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(with(new Division)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('name_bn')->nullable();
      $table->text('url')->nullable();
      $table->timestamps();
    });
    $divisions = array(
      array('id' => '1', 'name' => 'Chattogrram', 'name_bn' => 'চট্টগ্রাম', 'url' => 'www.chittagongdiv.gov.bd'),
      array('id' => '2', 'name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'url' => 'www.rajshahidiv.gov.bd'),
      array('id' => '3', 'name' => 'Khulna', 'name_bn' => 'খুলনা', 'url' => 'www.khulnadiv.gov.bd'),
      array('id' => '4', 'name' => 'Barishal', 'name_bn' => 'বরিশাল', 'url' => 'www.barisaldiv.gov.bd'),
      array('id' => '5', 'name' => 'Sylhet', 'name_bn' => 'সিলেট', 'url' => 'www.sylhetdiv.gov.bd'),
      array('id' => '6', 'name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'url' => 'www.dhakadiv.gov.bd'),
      array('id' => '7', 'name' => 'Rangpur', 'name_bn' => 'রংপুর', 'url' => 'www.rangpurdiv.gov.bd'),
      array('id' => '8', 'name' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'url' => 'www.mymensinghdiv.gov.bd')
    );
    \Illuminate\Support\Facades\DB::table(with(new Division)->getTable())->insert($divisions);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists(with(new Division)->getTable());
  }
};
