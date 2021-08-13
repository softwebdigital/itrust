<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $transactions = Transaction::query()->where('status', '!=', 'pending')->latest()->get();
        return view('admin.transactions', compact('admin', 'transactions'));
    }

    public function deposits()
    {
        $admin = auth('admin')->user();
        $deposits = Transaction::query()->where('type', 'deposit')->latest()->get();
        return view('admin.deposits', compact('admin', 'deposits'));
    }

    public function depositAction(Transaction $transaction, $action): RedirectResponse
    {
        if (!$transaction || $transaction['type'] != 'deposit') return back()->with('warning', 'Please check that you are taking action on the right deposit.');
        if (!in_array($action, ['approved', 'declined'])) return back()->with('error', 'Invalid action');

        if ($transaction->update(['status' => $action])) {
            $amount = $transaction['method'] == 'bank' ? '$'.number_format($transaction['amount'], 2) : round($transaction['amount'], 8);
            $mail = [
                'subject' => 'Deposit '.$action,
                'name' => $transaction->user()->first()->name,
                'body' => 'Your deposit of '.$amount.' BTC'.' has been '.$action.'.',
            ];
            MailController::sendDepositNotification($transaction->user()->first(), $mail);
        } else return back()->with('error', 'An error occurred, try again.');
        return back()->with('success', 'Deposit '.$action.' successfully');
    }

    public function payouts()
    {
        $admin = auth('admin')->user();
        $payouts = Transaction::query()->where('type', 'payout')->latest()->get();
        return view('admin.payouts', compact('admin', 'payouts'));
    }

    public function payoutAction(Transaction $transaction, $action): RedirectResponse
    {
        if (!$transaction || $transaction['type'] != 'payout') return back()->with('warning', 'Please check that you are taking action on the right payout.');
        if (!in_array($action, ['approved', 'declined'])) return back()->with('error', 'Invalid action');

        if ($transaction->update(['status' => $action])) {
            //
        } else return back()->with('error', 'An error occurred, try again.');


        return back()->with('success', 'Payout '.$action.' successfully');
    }


    public function userStatements()
    {
        return view('user.statement');
    }

    public function userTransactions()
    {
        $user = User::find(auth()->id());
        $transactions = $user->transactions()->latest()->get();
        return view('user.transactions', compact('user', 'transactions'));
    }

    public function userDepositStore(Request $request): RedirectResponse
    {
        $user = User::find(auth()->id());
        $validator = Validator::make($request->all(), [
            'method' => 'required|string',
            'amount' => 'required_if:method,bank',
            'btc_amount' => 'required_if:method,bitcoin'
        ]);
        if ($validator->fails()) return back()->with(['validation' => true, 'method' => $request['method']])->withErrors($validator)->withInput();

        if ($request['method'] == 'bank' && (float) $request['amount'] > 0) {
            if ($user->transactions()->create(['method' => 'bank', 'amount' => (float) $request['amount'], 'type' => 'deposit'])) {
                $msg = 'Deposit successful and is pending confirmation';
                $body = '<p>Your deposit of $'.number_format($request['amount'], 2).' was successful. Your deposit would be confirmed in a couple of minutes. </p>';
            }
            else
                return back()->with(['validation' => true, 'method' => $request['method'], 'error' => 'Deposit was not successful, try again'])->withInput();
        } elseif ($request['method'] == 'bitcoin' && $request['btc_amount'] > 0) {
            $amount = round((float) $request['btc_amount'] / 44000, 8);
            if ($user->transactions()->create(['method' => 'bitcoin', 'amount' => $amount, 'type' => 'deposit'])) {
                $msg = 'Deposit successful and is pending confirmation';
                $body = '<p>Your deposit of '.$amount.'BTC was successful. Your deposit would be confirmed in a couple of minutes. </p>';
            }
            else
                return back()->with(['validation' => true, 'method' => $request['method'], 'error' => 'Deposit was not successful, try again'])->withInput();
        } else
            return back()->with(['validation' => true, 'method' => $request['method'], 'error' => 'Invalid payment method selected'])->withInput();

        $mail = [
            'name' => $user->name,
            'subject' => 'Deposit successful',
            'body' => $body
        ];
        MailController::sendDepositNotification($user, $mail);
        return redirect()->route('user.transactions')->with($msg);
    }
}
