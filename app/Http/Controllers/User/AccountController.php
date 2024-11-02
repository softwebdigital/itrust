<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index() {

    }

    public static function existingAccount() 
    {
        // Retrieve all users in batches to avoid memory overload with large datasets
        User::chunk(1000, function ($users) {
            foreach ($users as $user) {
                // Check if the user has a wallet
                $wallet = $user->wallet;

                // Define the required accounts with default values of 0 for users without wallets
                $accountsData = [
                    [
                        'name' => 'brokage_bal',
                        'trading' => $wallet ? $wallet->it_wallet : 0,  // If wallet exists, use it_wallet; otherwise, use 0
                        'cash' => $wallet ? $wallet->ic_wallet : 0,     // If wallet exists, use ic_wallet; otherwise, use 0
                        'account_code' => 001,
                    ],
                    [
                        'name' => 'tfsa_bal',
                        'trading' => 0,
                        'cash' => 0,
                        'account_code' => 002,
                    ],
                    [
                        'name' => 'offshore_bal',
                        'trading' => $wallet ? $wallet->ot_wallet : 0,  // If wallet exists, use ot_wallet; otherwise, use 0
                        'cash' => $wallet ? $wallet->oc_wallet : 0,     // If wallet exists, use oc_wallet; otherwise, use 0
                        'account_code' => 003,
                    ],
                ];

                // Get the existing accounts for the user
                $existingAccounts = $user->accounts()->pluck('name')->toArray();

                // Loop through the required accounts and either update or create them
                foreach ($accountsData as $accountData) {
                    if (in_array($accountData['name'], $existingAccounts)) {
                        // If the account exists, update it
                        $user->accounts()
                            ->where('name', $accountData['name'])
                            ->update([
                                'trading' => $accountData['trading'],
                                'cash' => $accountData['cash'],
                                'account_code' => $accountData['account_code']
                            ]);
                    } else {
                        // If the account does not exist, create it
                        Account::create([
                            'user_id' => $user->id,
                            'name' => $accountData['name'],
                            'trading' => $accountData['trading'],
                            'cash' => $accountData['cash'],
                            'account_code' => $accountData['account_code'],
                        ]);
                    }
                }
            }
        });

        logger('Command ran successfully!');
    }

}
