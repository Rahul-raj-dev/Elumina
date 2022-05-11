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
        Schema::create('customer_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('verifier_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->string('status_id')->constrained('status');
            $table->string('remarks')->nullable();
            $table->foreignId('reason_id')->constrained('verification_reasons');
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
        Schema::dropIfExists('customer_verifications');
    }
};
