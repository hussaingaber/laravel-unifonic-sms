<?php

declare(strict_types=1);

namespace GranadaPride\UnifonicSms;

use GranadaPride\UnifonicSms\Channels\UnifonicSmsChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class UnifonicSmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/unifonic.php', 'unifonic');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/unifonic.php' => config_path('unifonic.php'),
        ]);

        $this->app->make(ChannelManager::class)->extend('unifonic', function () {
            return new UnifonicSmsChannel;
        });
    }
}
