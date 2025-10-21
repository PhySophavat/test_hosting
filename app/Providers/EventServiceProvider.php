<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogUserLogin',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogUserLogout',
        ],
    ];

    public function boot(): void
    {
        //
    }
}
