<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeroImageToConfigurations extends Migration
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
                'key' => 'hero_image',
                'value' => 'https://nomads-clan.com/img/89e321226740c4e8a15ece6605a6378e.png',
                'type' => 'text',
                'display_name' => 'Hero Image',
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
            ->where('key', 'hero_image')
            ->delete();
    }
}