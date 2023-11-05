<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\BotNotification;
use App\Notifications\WebNotification;
use App\Notifications\VerifiedNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransactionNotification;
use App\Notifications\SendActionDepositNotification;
use App\Notifications\SendRequestDepositNotification;
use App\Notifications\SendActionWithdrawalNotification;
use App\Notifications\SendRequestWithdrawalNotification;
use App\Notifications\SendRequestWithdrawalNotificationToAdmin;

class MailController extends Controller
{
    public static function sendDepositNotification($user, $data)
    {
        Notification::send($user, new TransactionNotification($data));
    }

    public static function sendInvestmentNotification($user, $data)
    {
        Notification::send($user, new WebNotification($data));
    }

    public static function sendBotNotification($user, $data)
    {
        Notification::send($user, new BotNotification($data));
    }

    public static function sendVerifiedNotification($user, $data)
    {
        Notification::send($user, new VerifiedNotification($data));
    }



    //NEW


    public static function sendRequestDepositNotification($user, $data)
    {
        Notification::send($user, new SendRequestDepositNotification($data));
    }


    public static function sendRequestWithdrawalNotification($user, $data)
    {
        Notification::send($user, new SendRequestWithdrawalNotification($data));
    }

    public static function sendTransactionNotificationToAdmin($email, $data)
    {
        Notification::send($email, new SendRequestWithdrawalNotificationToAdmin($data));
    }

    public static function sendActionDepositNotification($user, $data)
    {
        Notification::send($user, new SendActionDepositNotification($data));
    }


    public static function sendActionWithdrawalNotification($user, $data)
    {
        Notification::send($user, new SendActionWithdrawalNotification($data));
    }
}
