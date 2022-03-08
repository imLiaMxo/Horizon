<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSteamidToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('steamid')->nullable();
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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('steamid');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
