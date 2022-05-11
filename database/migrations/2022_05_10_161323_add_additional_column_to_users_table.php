<?php

use App\Models\Role;
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
        $table->foreignId('role_id')->after('email_verified_at')->default(Role::where('name', 'customer')->first()->id)->constrained('roles');
        });
       User::whereIn('email', ['elumina@elumina.com', 'admin@elumina.in'])
        ->update([
          'role_id'=> Role::where('name', 'Admin')->first()->id,
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
            $table->dropColumn('role_id');
        });
    }
};
