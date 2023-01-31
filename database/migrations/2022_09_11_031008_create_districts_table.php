<?php

use App\Models\District;
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
    Schema::create(with(new District)->getTable(), function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('division_id');
      $table->string('name');
      $table->string('name_bn')->nullable();
      $table->text('url')->nullable();
      $table->timestamps();
    });
    $districts = array(
      array('id' => '1', 'division_id' => '1', 'name' => 'Cumilla', 'name_bn' => 'কুমিল্লা', 'url' => 'www.comilla.gov.bd'),
      array('id' => '2', 'division_id' => '1', 'name' => 'Feni', 'name_bn' => 'ফেনী', 'url' => 'www.feni.gov.bd'),
      array('id' => '3', 'division_id' => '1', 'name' => 'Brahmanbaria', 'name_bn' => 'ব্রাহ্মণবাড়িয়া', 'url' => 'www.brahmanbaria.gov.bd'),
      array('id' => '4', 'division_id' => '1', 'name' => 'Rangamati', 'name_bn' => 'রাঙ্গামাটি', 'url' => 'www.rangamati.gov.bd'),
      array('id' => '5', 'division_id' => '1', 'name' => 'Noakhali', 'name_bn' => 'নোয়াখালী', 'url' => 'www.noakhali.gov.bd'),
      array('id' => '6', 'division_id' => '1', 'name' => 'Chandpur', 'name_bn' => 'চাঁদপুর', 'url' => 'www.chandpur.gov.bd'),
      array('id' => '7', 'division_id' => '1', 'name' => 'Lakshmipur', 'name_bn' => 'লক্ষ্মীপুর', 'url' => 'www.lakshmipur.gov.bd'),
      array('id' => '8', 'division_id' => '1', 'name' => 'Chattogrram', 'name_bn' => 'চট্টগ্রাম', 'url' => 'www.chittagong.gov.bd'),
      array('id' => '9', 'division_id' => '1', 'name' => 'Coxsbazar', 'name_bn' => 'কক্সবাজার', 'url' => 'www.coxsbazar.gov.bd'),
      array('id' => '10', 'division_id' => '1', 'name' => 'Khagrachhari', 'name_bn' => 'খাগড়াছড়ি', 'url' => 'www.khagrachhari.gov.bd'),
      array('id' => '11', 'division_id' => '1', 'name' => 'Bandarban', 'name_bn' => 'বান্দরবান', 'url' => 'www.bandarban.gov.bd'),
      array('id' => '12', 'division_id' => '2', 'name' => 'Sirajganj', 'name_bn' => 'সিরাজগঞ্জ', 'url' => 'www.sirajganj.gov.bd'),
      array('id' => '13', 'division_id' => '2', 'name' => 'Pabna', 'name_bn' => 'পাবনা', 'url' => 'www.pabna.gov.bd'),
      array('id' => '14', 'division_id' => '2', 'name' => 'Bogura', 'name_bn' => 'বগুড়া', 'url' => 'www.bogra.gov.bd'),
      array('id' => '15', 'division_id' => '2', 'name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'url' => 'www.rajshahi.gov.bd'),
      array('id' => '16', 'division_id' => '2', 'name' => 'Natore', 'name_bn' => 'নাটোর', 'url' => 'www.natore.gov.bd'),
      array('id' => '17', 'division_id' => '2', 'name' => 'Joypurhat', 'name_bn' => 'জয়পুরহাট', 'url' => 'www.joypurhat.gov.bd'),
      array('id' => '18', 'division_id' => '2', 'name' => 'Chapainawabganj', 'name_bn' => 'চাঁপাইনবাবগঞ্জ', 'url' => 'www.chapainawabganj.gov.bd'),
      array('id' => '19', 'division_id' => '2', 'name' => 'Naogaon', 'name_bn' => 'নওগাঁ', 'url' => 'www.naogaon.gov.bd'),
      array('id' => '20', 'division_id' => '3', 'name' => 'Jashore', 'name_bn' => 'যশোর', 'url' => 'www.jessore.gov.bd'),
      array('id' => '21', 'division_id' => '3', 'name' => 'Satkhira', 'name_bn' => 'সাতক্ষীরা', 'url' => 'www.satkhira.gov.bd'),
      array('id' => '22', 'division_id' => '3', 'name' => 'Meherpur', 'name_bn' => 'মেহেরপুর', 'url' => 'www.meherpur.gov.bd'),
      array('id' => '23', 'division_id' => '3', 'name' => 'Narail', 'name_bn' => 'নড়াইল', 'url' => 'www.narail.gov.bd'),
      array('id' => '24', 'division_id' => '3', 'name' => 'Chuadanga', 'name_bn' => 'চুয়াডাঙ্গা', 'url' => 'www.chuadanga.gov.bd'),
      array('id' => '25', 'division_id' => '3', 'name' => 'Kushtia', 'name_bn' => 'কুষ্টিয়া', 'url' => 'www.kushtia.gov.bd'),
      array('id' => '26', 'division_id' => '3', 'name' => 'Magura', 'name_bn' => 'মাগুরা', 'url' => 'www.magura.gov.bd'),
      array('id' => '27', 'division_id' => '3', 'name' => 'Khulna', 'name_bn' => 'খুলনা', 'url' => 'www.khulna.gov.bd'),
      array('id' => '28', 'division_id' => '3', 'name' => 'Bagerhat', 'name_bn' => 'বাগেরহাট', 'url' => 'www.bagerhat.gov.bd'),
      array('id' => '29', 'division_id' => '3', 'name' => 'Jhenaidah', 'name_bn' => 'ঝিনাইদহ', 'url' => 'www.jhenaidah.gov.bd'),
      array('id' => '30', 'division_id' => '4', 'name' => 'Jhalakathi', 'name_bn' => 'ঝালকাঠি', 'url' => 'www.jhalakathi.gov.bd'),
      array('id' => '31', 'division_id' => '4', 'name' => 'Patuakhali', 'name_bn' => 'পটুয়াখালী', 'url' => 'www.patuakhali.gov.bd'),
      array('id' => '32', 'division_id' => '4', 'name' => 'Pirojpur', 'name_bn' => 'পিরোজপুর', 'url' => 'www.pirojpur.gov.bd'),
      array('id' => '33', 'division_id' => '4', 'name' => 'Barishal', 'name_bn' => 'বরিশাল', 'url' => 'www.barisal.gov.bd'),
      array('id' => '34', 'division_id' => '4', 'name' => 'Bhola', 'name_bn' => 'ভোলা', 'url' => 'www.bhola.gov.bd'),
      array('id' => '35', 'division_id' => '4', 'name' => 'Barguna', 'name_bn' => 'বরগুনা', 'url' => 'www.barguna.gov.bd'),
      array('id' => '36', 'division_id' => '5', 'name' => 'Sylhet', 'name_bn' => 'সিলেট', 'url' => 'www.sylhet.gov.bd'),
      array('id' => '37', 'division_id' => '5', 'name' => 'Moulvibazar', 'name_bn' => 'মৌলভীবাজার', 'url' => 'www.moulvibazar.gov.bd'),
      array('id' => '38', 'division_id' => '5', 'name' => 'Habiganj', 'name_bn' => 'হবিগঞ্জ', 'url' => 'www.habiganj.gov.bd'),
      array('id' => '39', 'division_id' => '5', 'name' => 'Sunamganj', 'name_bn' => 'সুনামগঞ্জ', 'url' => 'www.sunamganj.gov.bd'),
      array('id' => '40', 'division_id' => '6', 'name' => 'Narsingdi', 'name_bn' => 'নরসিংদী', 'url' => 'www.narsingdi.gov.bd'),
      array('id' => '41', 'division_id' => '6', 'name' => 'Gazipur', 'name_bn' => 'গাজীপুর', 'url' => 'www.gazipur.gov.bd'),
      array('id' => '42', 'division_id' => '6', 'name' => 'Shariatpur', 'name_bn' => 'শরীয়তপুর', 'url' => 'www.shariatpur.gov.bd'),
      array('id' => '43', 'division_id' => '6', 'name' => 'Narayanganj', 'name_bn' => 'নারায়ণগঞ্জ', 'url' => 'www.narayanganj.gov.bd'),
      array('id' => '44', 'division_id' => '6', 'name' => 'Tangail', 'name_bn' => 'টাঙ্গাইল', 'url' => 'www.tangail.gov.bd'),
      array('id' => '45', 'division_id' => '6', 'name' => 'Kishoreganj', 'name_bn' => 'কিশোরগঞ্জ', 'url' => 'www.kishoreganj.gov.bd'),
      array('id' => '46', 'division_id' => '6', 'name' => 'Manikganj', 'name_bn' => 'মানিকগঞ্জ', 'url' => 'www.manikganj.gov.bd'),
      array('id' => '47', 'division_id' => '6', 'name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'url' => 'www.dhaka.gov.bd'),
      array('id' => '48', 'division_id' => '6', 'name' => 'Munshiganj', 'name_bn' => 'মুন্সিগঞ্জ', 'url' => 'www.munshiganj.gov.bd'),
      array('id' => '49', 'division_id' => '6', 'name' => 'Rajbari', 'name_bn' => 'রাজবাড়ী', 'url' => 'www.rajbari.gov.bd'),
      array('id' => '50', 'division_id' => '6', 'name' => 'Madaripur', 'name_bn' => 'মাদারীপুর', 'url' => 'www.madaripur.gov.bd'),
      array('id' => '51', 'division_id' => '6', 'name' => 'Gopalganj', 'name_bn' => 'গোপালগঞ্জ', 'url' => 'www.gopalganj.gov.bd'),
      array('id' => '52', 'division_id' => '6', 'name' => 'Faridpur', 'name_bn' => 'ফরিদপুর', 'url' => 'www.faridpur.gov.bd'),
      array('id' => '53', 'division_id' => '7', 'name' => 'Panchagarh', 'name_bn' => 'পঞ্চগড়', 'url' => 'www.panchagarh.gov.bd'),
      array('id' => '54', 'division_id' => '7', 'name' => 'Dinajpur', 'name_bn' => 'দিনাজপুর', 'url' => 'www.dinajpur.gov.bd'),
      array('id' => '55', 'division_id' => '7', 'name' => 'Lalmonirhat', 'name_bn' => 'লালমনিরহাট', 'url' => 'www.lalmonirhat.gov.bd'),
      array('id' => '56', 'division_id' => '7', 'name' => 'Nilphamari', 'name_bn' => 'নীলফামারী', 'url' => 'www.nilphamari.gov.bd'),
      array('id' => '57', 'division_id' => '7', 'name' => 'Gaibandha', 'name_bn' => 'গাইবান্ধা', 'url' => 'www.gaibandha.gov.bd'),
      array('id' => '58', 'division_id' => '7', 'name' => 'Thakurgaon', 'name_bn' => 'ঠাকুরগাঁও', 'url' => 'www.thakurgaon.gov.bd'),
      array('id' => '59', 'division_id' => '7', 'name' => 'Rangpur', 'name_bn' => 'রংপুর', 'url' => 'www.rangpur.gov.bd'),
      array('id' => '60', 'division_id' => '7', 'name' => 'Kurigram', 'name_bn' => 'কুড়িগ্রাম', 'url' => 'www.kurigram.gov.bd'),
      array('id' => '61', 'division_id' => '8', 'name' => 'Sherpur', 'name_bn' => 'শেরপুর', 'url' => 'www.sherpur.gov.bd'),
      array('id' => '62', 'division_id' => '8', 'name' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'url' => 'www.mymensingh.gov.bd'),
      array('id' => '63', 'division_id' => '8', 'name' => 'Jamalpur', 'name_bn' => 'জামালপুর', 'url' => 'www.jamalpur.gov.bd'),
      array('id' => '64', 'division_id' => '8', 'name' => 'Netrokona', 'name_bn' => 'নেত্রকোণা', 'url' => 'www.netrokona.gov.bd')
    );

    \Illuminate\Support\Facades\DB::table(with(new District)->getTable())->insert($districts);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists(with(new District)->getTable());
  }
};
