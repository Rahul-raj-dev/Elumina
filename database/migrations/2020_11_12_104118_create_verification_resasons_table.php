<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationResasonsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('verification_reasons', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->timestamps();
    });
    DB::table('verification_reasons')->delete();
    $verification_reasons = array(
      array('id' => 1, 'name' => 'All details verified'),
      array('id' => 2, 'name' => 'Fake Customer'),
      array('id' => 3, 'name' => 'Fraud Customer'),
      array('id' => 4, 'name' => 'Broker’s Customer'),
      array('id' => 5, 'name' => 'Underaged Customer'),
      array('id' => 6, 'name' => 'Abusive Customer'),
      array('id' => 7, 'name' => 'Registered for Friendship'),
      array('id' => 8, 'name' => 'Registered for Business purpose'),
      array('id' => 9, 'name' => 'Junk Customer'),
      array('id' => 10, 'name' => 'Test Customer'),
      array('id' => 11, 'name' => 'Duplicate Customer'),
    );
    DB::table('verification_reasons')->insert($verification_reasons);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('verification_resasons');
  }
}
