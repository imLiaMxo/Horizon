<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedStepOutcomeToApplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applies', function (Blueprint $table) {
            $table->string('assigned_to')->nullable();
            $table->integer('current_step')->nullable();
            $table->integer('outcome')->nullable();
            $table->string('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applies', function (Blueprint $table) {
            $table->dropColumn('assigned_to');
            $table->dropColumn('current_step');
            $table->dropColumn('outcome');
            $table->dropColumn('reason');
        });
    }
}
