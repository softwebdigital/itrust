<?php

namespace App\Providers;

use App\Listeners\AccountCreatedListener;
use App\Listeners\EmailVerifiedListener;
use App\Listeners\UpdateDeviceListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AccountCreatedListener::class,
            UpdateDeviceListener::class,
        ],
        Login::class => [
            UpdateDeviceListener::class,
        ],
        Verified::class => [
            EmailVerifiedListener::class,
            UpdateDeviceListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
