<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\SendActionDepositNotification;
use App\Notifications\SendActionWithdrawalNotification;
use App\Notifications\SendRequestDepositNotification;
use App\Notifications\SendRequestWithdrawalNotification;
use App\Notifications\TransactionNotification;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    public static function sendDepositNotification($user, $data)
    {
        Notification::send($user, new TransactionNotification($data));
    }

    public static function sendInvestmentNotification($user, $data)
    {
        Notification::send($user, new TransactionNotification($data));
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

    public static function sendActionDepositNotification($user, $data)
    {
        Notification::send($user, new SendActionDepositNotification($data));
    }


    public static function sendActionWithdrawalNotification($user, $data)
    {
        Notification::send($user, new SendActionWithdrawalNotification($data));
    }
}
