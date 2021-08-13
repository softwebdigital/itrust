<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\TransactionNotification;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    public static function sendDepositNotification($user, $data)
    {
        Notification::send($user, new TransactionNotification($data));
    }
}
