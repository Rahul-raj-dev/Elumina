<?php

use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        $table->foreignId('status_id')->after('role_id')->default(Status::where('status', 'Inreview')->first()->id)->constrained('status');
        });
        User::whereIn('email', ['elumina@elumina.com', 'admin@elumina.in'])
        ->update([
          'status_id'=> Status::where('status', 'Approved')->first()->id,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('status_id');
        });
    }
};
