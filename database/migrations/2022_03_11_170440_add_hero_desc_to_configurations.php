<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeroDescToConfigurations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('configurations')
            ->insert(
            [
                'key' => 'hero_desc',
                'value' => 'It does not matter who you are, or where you are from. You can join us 24/7!',
                'type' => 'text',
                'display_name' => 'Hero Description',
                'category' => 'general',
                'updated_at' => now()
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('configurations')
            ->where('key', 'hero_desc')
            ->delete();
    }
}