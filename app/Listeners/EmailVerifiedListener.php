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
            'message' => '<p>Your path to automated trading starts here, and we are happy you joined!
            </p><p>There are a LOT of things you can do with Itrust, and we want to make sure you get the most out of
            it.
            </p><p>So let us begin with the best ways to get you started:</p><ul><li><b>Copy Other Traders</b></li></ul><p>Pick &amp; choose templates and strategies</p><ul><li><b>
            Use The Best Trading Bot</b></li></ul><p>
            Configure how your bot should buy &amp; sell
            </p><ul><li>1<b>00% Automated Trading
            </b></li></ul><p>Use Automated signals that trades on your behalf
            </p><p><b>Questions?
            </b></p><p>Write <a href="support@itrustinvestment.com" target="_blank">support@itrustinvestment.com</a>, and we will get back to you as soon as possible</p>'
        ];

        Notification::send($user, new WelcomeNotification($welcomeData));
    }
}
