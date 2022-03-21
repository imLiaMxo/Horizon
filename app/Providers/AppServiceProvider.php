<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Support\WordFilterService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(WordFilterService::class);

        Schema::defaultStringLength(191);

        $this->loadConfigurations();

        Configuration::updated(function () {
            Cache::forget('configurations');
            $this->loadConfigurations();
        });
        
        \URL::forceScheme('https');
    }

    protected function loadConfigurations()
    {
        if ($this->app->runningInConsole()) return;

        $configurations = Cache::rememberForever('configurations', function () {
            return Configuration::all()
                ->mapWithKeys(function ($configuration) {
                    return [$configuration->key => $configuration->value];
                });
        });

        config()->set('horizon.configs', $configurations);
    }
}
