<?php

namespace App\Listeners;

use App\Notifications\WelcomeNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class EmailVerifiedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Verified $event
     * @return void
     */
    public function handle(Verified $event)
    {
        $user = $event->user;
        $welcomeData = [
            'name' => $user['first_name'],
            'title' => 'Welcome to '.env('APP_NAME'),
            'message' => 'Welcome to '.env('APP_NAME').'.',
        ];

        Notification::send($user, new WelcomeNotification($welcomeData));
    }
}
