<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SettingsSeeder
 */
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $curDate = now();

        $configurations = collect(array_merge(
            $this->metaConfigurations(),
            $this->generalConfigurations(),
            $this->integrationConfigurations(),
            $this->storeConfigurations()
        ))->map(function($configuration) use ($curDate) {
            return $configuration + [
                'display_name' => null,
                'category' => null,
                'updated_at' => $curDate
            ];
        })->toArray();

        DB::table('configurations')->insertOrIgnore($configurations);
    }

    /**
     * Returns an array of configurations belonging to the "meta" category
     *
     * @return array
     */
    protected function metaConfigurations(): array
    {
        return [
            [
                'key' => 'meta_title',
                'value' => 'Nomads',
                'type' => 'text',
                'display_name' => 'Meta Title',
                'category' => 'general.meta',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Horizon the only web application you\'ll ever need',
                'type' => 'text',
                'display_name' => 'Meta Description',
                'category' => 'general.meta'
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'horizon,web,index,forums,steam',
                'type' => 'text',
                'display_name' => 'Meta Keywords',
                'category' => 'general.meta',
            ],
            [
                'key' => 'meta_type',
                'value' => 'article',
                'type' => 'text',
                'display_name' => 'Meta Type',
                'category' => 'general.meta',
            ],
            [
                'key' => 'meta_color',
                'value' => '#2196F3',
                'type' => 'color',
                'display_name' => 'Meta Color',
                'category' => 'general.meta',
            ]
        ];
    }

    /**
     * Returns an array of configurations belonging to the "general" category
     *
     * @return array
     */
    protected function generalConfigurations(): array
    {
        return [
            [
                'key' => 'site_name',
                'value' => 'Nomads',
                'type' => 'text',
                'display_name' => 'Site Name',
                'category' => 'general.site'
            ],
            [
                'key' => 'site_logo',
                'value' => asset('img/logo.png'),
                'type' => 'text',
                'display_name' => 'Site Logo',
                'category' => 'general.site'
            ],
            [
                'key' => 'forums_title',
                'value' => 'Forums',
                'type' => 'text',
                'display_name' => 'Forums Title',
                'category' => 'general'
            ],
            [
                'key' => 'forums_description',
                'value' => 'See what everyone is up to!',
                'type' => 'text',
                'display_name' => 'Forums Description',
                'category' => 'general'
            ],
        ];
    }

    /**
     * Returns an array of configurations belonging to the "integrations" category
     *
     * @return array
     */
    protected function integrationConfigurations(): array
    {
        return [
            [
                'key' => 'discord_invite_url',
                'value' => 'https://discord.gg/WzqQMBU',
                'type' => 'text',
                'display_name' => 'Discord Invite URL',
                'category' => 'integrations.discord',
            ],
            [
                'key' => 'steam_api_key',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Steam API Key (<a href="https://steamcommunity.com/dev/apikey">https://steamcommunity.com/dev/apikey</a>)',
                'category' => 'integrations.steam'
            ],
            [
                'key' => 'steam_group_slug',
                'value' => 'asap-rp',
                'type' => 'text',
                'display_name' => 'Steam Group Slug',
                'category' => 'integrations.steam'
            ]
        ];
    }

    /**
     * Returns an array of configurations belonging to the "store" category
     *
     * @return array
     */
    protected function storeConfigurations(): array
    {
        return [
            [
                'key' => 'monthly_goal_enabled',
                'value' => true,
                'type' => 'boolean',
                'display_name' => 'Monthly Goal Enabled',
                'category' => 'store'
            ],
            [
                'key' => 'monthly_goal',
                'value' => 5,
                'type' => 'number',
                'display_name' => 'Monthly Goal',
                'category' => 'store'
            ],
            [
                'key' => 'paypal_client_id',
                'value' => '',
                'type' => 'text',
                'display_name' => 'PayPal Client ID (<a href="https://developer.paypal.com">https://developer.paypal.com</a>)',
                'category' => 'store.paypal'
            ],
            [
                'key' => 'paypal_client_secret',
                'value' => '',
                'type' => 'text',
                'display_name' => 'PayPal Client Secret (<a href="https://developer.paypal.com">https://developer.paypal.com</a>)',
                'category' => 'store.paypal'
            ],
            [
                'key' => 'paypal_sandbox_enabled',
                'value' => false,
                'type' => 'boolean',
                'display_name' => 'PayPal Sandbox Mode',
                'category' => 'store.paypal'
            ],
            [
                'key' => 'donation_currency',
                'value' => 'USD',
                'type' => 'currency',
                'display_name' => 'donation_currency',
                'category' => 'store.misc'
            ],
            [
                'key' => 'terms_of_service',
                'value' => '<strong>Your terms of service go here!</strong>',
                'type' => 'rich_text',
                'display_name' => 'Terms of Service',
                'category' => 'store.misc'
            ]
        ];
    }
}
