<?php

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
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });
        DB::table('status')->delete();
    $status = array(
      array('id' => 1,'status' => 'Inreview'),
      array('id' => 2,'status' => 'Approved'),
      array('id' => 3,'status' => 'Rejected'),
    );
    DB::table('status')->insert($status);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
};
