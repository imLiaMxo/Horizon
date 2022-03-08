<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        User::create([
            'name' => 'Liam',
            'steamid' => '76561198157318784',
            'avatar' => 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/22/22d553ba88ec7f368b19ec2b6867aad75830c865_medium.jpg',
        ])->assignRole('president');
    }
}
