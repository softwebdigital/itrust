<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Investment;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\SendEmailHistoryOfAccount;
use App\Notifications\SendEmailStatementOfAccount;
use App\Notifications\SendLatestInvoiceNotification;
use PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $transactions = Transaction::query()
                        // ->where('status', '!=', 'pending')
                        ->latest('created_at')->get();
        return view('admin.transactions', compact('admin', 'transactions'));
    }

    public function deposits()
    {
        $admin = auth('admin')->user();
        $deposits = Transaction::query()->where('type', 'deposit')->latest('created_at')->get();
        $users = User::all();

        return view('admin.deposits', compact('admin', 'deposits', 'users'));
    }

    public function depositAction(Transaction $transaction, $action): RedirectResponse
    {
        if ($transaction['type'] != 'deposit') return back()->with('warning', 'Please check that you are taking action on the right deposit.');
        if (!in_array($action, ['approved', 'declined', 'delete'])) return back()->with('error', 'Invalid action');

        if ($action == 'delete') {
            $transaction->delete();
        }
        else {
            if ($transaction->update(['status' => $action])) {
                $amount = $transaction['method'] == 'bank' ? '$' . number_format($transaction['amount'], 2) : round($transaction['amount'], 8) . 'BTC';
                // dd($amount);

                $mail = [
                    'subject' => 'Deposit ' . ucfirst($action),
                    'name' => $transaction->user()->first()->name,
                    'body' => ($transaction['method'] == 'bank' ? 'Your Bank' : 'Your Bitcoin') . ' deposit of ' . $amount . ' has been received
                    and processed.',
                ];
                if ($action == 'declined') {
                    $mail['body'] = ($transaction['method'] == 'bank' ? 'Your Bank' : 'Your Bitcoin') . ' deposit of ' . $amount . ' has been declined. Kindly contact support@itrustinvestment.com for further inquiries !';
                }
                MailController::sendActionDepositNotification($transaction->user()->first(), $mail);
            } else return back()->with('error', 'An error occurred, try again.');
        }
        return back()->with('success', 'Deposit '.($action == 'delete' ? 'deleted' : $action).' successfully');
    }

    public function payouts()
    {
        $admin = auth('admin')->user();
        $payouts = Transaction::query()->where('type', 'payout')->latest('created_at')->get();
        $users = User::all();

        return view('admin.payouts', compact('admin', 'payouts', 'users'));
    }

    public function payoutAction(Transaction $transaction, $action): RedirectResponse
    {
        if ($transaction['type'] != 'payout') return back()->with('warning', 'Please check that you are taking action on the right payout.');
        if (!in_array($action, ['approved', 'declined', 'delete'])) return back()->with('error', 'Invalid action');

        if ($action == 'delete') {
            $transaction->delete();
        }
        else {
            if ($transaction->update(['status' => $action])) {
                $amount = $transaction['method'] == 'bank' ? '$' . number_format($transaction['amount'], 2) : round($transaction['amount'], 8) . 'BTC';
                // dd($amount);

                $mail = [
                    'subject' => 'Withdrawal ' . ucfirst($action),
                    'name' => $transaction->user()->first()->name,
                    'body' => ($transaction['method'] == 'bank' ? 'Your Bank' : 'Your Bitcoin') . ' withdrawal of ' . $amount . ' has been received
                and processed. ' . $amount . ' has been sent to your' . ($transaction['method'] == 'bank' ? ' Bank details below:' : ' Bitcoin below:'),
                ];
                if ($transaction['method'] == 'bitcoin') {
                    $mail['btc_wallet'] = $transaction['btc_wallet'];
                    $mail['type'] = 'btc';
                } else {
                    $mail['bank'] = $transaction['bank_name'];
                    $mail['acct_name'] = $transaction['acct_name'];
                    $mail['number'] = $transaction['acct_no'];
                    $mail['type'] = 'bank';
                }
                $mail['action'] = $action;
                if ($action == 'declined') {
                    $mail['body'] = ($transaction['method'] == 'bank' ? 'Your Bank' : 'Your Bitcoin') . ' withdrawal of ' . $amount . ' has been declined. Kindly contact support@itrustinvestment.com for further inquiries !';
                }
                MailController::SendActionWithdrawalNotification($transaction->user()->first(), $mail);
            } else return back()->with('error', 'An error occurred, try again.');
        }
        return back()->with('success', 'Payout '.($action != 'delete' ? $action : 'deleted').' successfully');
    }


    public function generalAction(Transaction $transaction, $action): RedirectResponse
    {
        // if (!$transaction || $transaction['type'] != 'payout') return back()->with('warning', 'Please check that you are taking action on the right payout.');
        if (!in_array($action, ['approved', 'declined'])) return back()->with('error', 'Invalid action');

        if ($transaction->update(['status' => $action])) {
            return back()->with('success', 'Transaction '.$action.' successfully');
        } else return back()->with('error', 'An error occurred, try again.');
    }


    public function userStatements()
    {
        $investments = Investment::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('user.statement', compact('investments'));
    }


    public function createStatementsPDF()
    {
        $investments = Investment::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $user = Auth::user();
        $array = [
            'inv' => $investments,
            'user' => $user['email']
        ];


        // // share data to view
        view()->share('investments',$array);
        $pdf = PDF::loadView('user.pdfstatement', $array);
        $pdf->stream('pdf_file.pdf');
        // dd($pdf->output());

        $name = $user['name'].'StatementOFAccount'.rand(10, 190718);
        $url = "public/pdf/$name.pdf";
        $public = "storage/pdf/$name.pdf";
        Storage::put($url, $pdf->output());
        $data = [
            'user' => $user,
            'pdf' => $public
        ];

        // return $pdf->download('invoice.pdf');
        Notification::send($user, new SendEmailStatementOfAccount($data));
        return back()->with('success', 'Account Statement Successfully sent to your email');


    }


    public function createHistoryPDF()
    {
        $user = User::find(auth()->id());
        $transactions = $user->transactions()->latest()->get();
        $array = [
            'inv' => $transactions,
            'user' => $user->email,
            'logo' => asset('img/itrust-logo-large.png')
        ];


        // // share data to view
        view()->share('investments',$array);
        $pdf = PDF::loadView('user.pdftrxn', $array);
        $pdf->stream('pdf_file.pdf');
        // dd($pdf->output());

        $name = $user->name.'StatementOFAccount'.rand(10, 190718);
        $url = "public/pdf/$name.pdf";
        $public = "storage/pdf/$name.pdf";
        Storage::put($url, $pdf->output());
        $data = [
            'user' => $user,
            'link' => $public,
            'pdf' => $pdf->output()
        ];

        // return $pdf->download('invoice.pdf');
        Notification::send($user, new SendEmailHistoryOfAccount($data));
        return back()->with('success', 'Account Statement Successfully sent to your email');


    }

    public function createInvoicePDF($type)
    {
        $user = User::find(auth()->id());
        if($type == 'statement'){
            $data = $user->investments()->latest()->first();
        }elseif($type == 'transaction'){
            $data = $user->transactions()->latest()->first();
        }
        $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
        $payouts = $user->payouts()->where('status', '=', 'approved')->sum('actual_amount');
        $inv = $user->roi()->sum('amount');
        $withdrawable = ($deposits - $payouts) - $inv;
        // dd($data);
        $array = [
            'user' => $user->email,
            'type' => $type,
            'withdrawable' => $withdrawable,
            'data' => $data,
            'logo' => asset('img/itrust-logo-large.png')
        ];
//         return view('user.invoice', compact('array'));


        // // share data to view
        view()->share('array',$array);
        $pdf = PDF::loadView('user.invoice', $array);
        $pdf->stream('pdf_file.pdf');
        // dd($pdf->output());

        $name = $user->name.'LatestInvoice'.rand(10, 190718);
        $url = "public/pdf/$name.pdf";
        $public = "storage/pdf/$name.pdf";
        $path = Storage::put($url, $pdf->output());
        $data = [
            'user' => $user,
            'link' => $public,
            'pdf' => $pdf->output()
        ];

        // return $pdf->download('invoice.pdf');
        Notification::send($user, new SendLatestInvoiceNotification($data));
        return back()->with('success', 'Latest Invoice Successfully sent to your email');


    }

    public function userTransactions()
    {
        $user = User::find(auth()->id());
        $transactions = $user->transactions()->latest()->get();
        return view('user.transactions', compact('user', 'transactions'));
    }

    public function deposit()
    {
        $user = User::find(auth()->id());
        $transactions = $user->deposits()->latest()->get();
        $setting = Settings::first();
        $offshore = Transaction::where(['user_id' => $user->id,'acct_type' => 'offshore', 'status' => 'approved'])->count();


        return view('user.deposit', compact('user', 'transactions', 'setting', 'offshore'));
    }

    public function withdraw()
    {
        $user = User::find(auth()->id());
        $transactions = $user->payouts()->latest()->get();
        $setting = Settings::first();
        $offshore = Transaction::where(['user_id' => $user->id,'acct_type' => 'offshore', 'status' => 'approved'])->count();

        return view('user.withdraw', compact('user', 'transactions', 'setting', 'offshore'));
    }

    public function userDepositStore(Request $request): RedirectResponse
    {

        $user = User::find(auth()->id());
        $validator = Validator::make($request->all(), [
            'method' => 'required|string',
            'amount' => 'required_if:method,bank',
            'btc_amount' => 'required_if:method,bitcoin',
            'acct_type' => 'required'
        ]);
        $setting = Settings::first();
        // dd($setting);
        if ($validator->fails()) return back()->with(['validation' => true, 'method' => $request['method']])->withErrors($validator)->withInput();

        $mail = [
            'name' => $user->name,
            'subject' => 'Deposit Request',
        ];


        if ($request['method'] == 'bank' && (float) $request['amount'] > 0) {
            if ($user->transactions()->create(['method' => 'bank', 'amount' => (float) $request['amount'], 'type' => 'deposit', 'actual_amount' => (float) $request['amount'], 'acct_type' => $request['acct_type']])) {
                $msg = 'Deposit successful and is pending confirmation';
                $mail['body'] = 'You’ve requested a Bank deposit of '.number_format($request['amount'], 2).', kindly make a
                payment of $'.number_format($request['amount'], 2).' to:';
                $mail['bank'] = $setting['bank_name'];
                $mail['acct_name'] = $setting['acct_name'];
                $mail['number'] = $setting['acct_no'];
                $mail['type'] = 'bank';

                $mailBody = '<p>A Bank deposit request of $'.number_format($request['amount'], 2).' by <b>'.$user->username.'</b> has been received.</p>';
            }
            else
                return back()->with(['validation' => true, 'method' => $request['method'], 'error' => 'Deposit was not successful, try again'])->withInput();
        } elseif ($request['method'] == 'bitcoin' && $request['btc_amount'] > 0) {
            $amount = round((float) $request['btc_amount'] / AdminController::getBTC(), 8);
            if ($user->transactions()->create(['method' => 'bitcoin', 'amount' => $amount, 'type' => 'deposit', 'actual_amount' => (float) $request['btc_amount'], 'acct_type' => $request['acct_type']])) {
                $msg = 'Deposit successful and is pending confirmation';
                $mail['body'] = 'You’ve requested a Bitcoin deposit of $'.number_format($request['btc_amount'], 2).', kindly make a payment of $'.number_format($request['btc_amount'], 2).' ('.$amount.'btc) to '.$user->btc_wallet;
                $mail['type'] = 'btc';
                $mailBody = '<p>A Bitcoin deposit request of $'.number_format($request['btc_amount'], 2).' by <b>'.$user->username.'</b> has been received.</p>';
            }
            else
                return back()->with(['validation' => true, 'method' => $request['method'], 'error' => 'Deposit was not successful, try again'])->withInput();
        } else
            return back()->with(['validation' => true, 'method' => $request['method'], 'error' => 'Invalid payment method selected'])->withInput();

        // dd($mail);
        MailController::sendRequestDepositNotification($user, $mail);
        $admin = new User;
        $admin['email'] = env('TRANX_EMAIL');
        $adminMail = [
            'subject' => 'Deposit Request',
            'body' => $mailBody,
            'btc_wallet' => $request['btc_wallet']
        ];
        MailController::sendTransactionNotificationToAdmin($admin, $adminMail);
        return redirect()->route('user.transactions')->with($msg);
    }

    public function userWithdrawStore(Request $request): RedirectResponse
    {

        $user = User::find(auth()->id());

        $validator = Validator::make($request->all(), [
            'w_method' => 'required|string',
            'bank_amount' => 'required_if:w_method,bank',
            'bank_name' => 'required_if:w_method,bank',
            'acct_name' => 'required_if:w_method,bank',
            'acct_no' => 'required_if:w_method,bank',
            'w_amount' => 'required_if:w_method,bitcoin',
            'btc_wallet' => 'required_if:w_method,bitcoin',
            'acct_type' => 'required'
        ], [], $this->attributes());
        // dd($validator);
        if ($validator->fails()) return back()->with(['validation' => true, 'w_method' => $request['w_method']])->withErrors($validator)->withInput();

        if ($user->offshore_payout()->where('status', '=', 'pending')->first() ||
            $user->ira_payout()->where('status', '=', 'pending')->first()
        )
            return back()->with('error', 'You have a pending withdrawal request.');

        $ira_deposit = $user->ira_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $ira_payout = $user->ira_payout()->where('status', '=', 'approved')->sum('actual_amount');
        $offshore_deposit = $user->offshore_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $offshore_payout = $user->offshore_payout()->where('status', '=', 'approved')->sum('actual_amount');
        $ira_roi = $user->ira_roi()->where('status', '=', 'closed')->sum('ROI');
        $ira_amount = $user->ira_roi()->where('status', '=', 'open')->sum('amount');
        $offshore_amount = $user->offshore_roi()->where('status', '=', 'open')->sum('amount');
        $offshore_roi = $user->offshore_roi()->where('status', '=', 'closed')->sum('ROI');
        $offshore = $offshore_deposit - $offshore_payout - $offshore_amount + $offshore_roi;
        $ira = $ira_deposit - $ira_payout - $ira_amount + $ira_roi;
        // dd($portfolioValue, $request['investment']);
        // dd($ira, $offshore);


        if ($request['w_method'] == 'bank' && (float) $request['bank_amount'] > 0) {
            // if((float) $request['bank_amount'] > $withdrawable){
            //     // dd($portfolioValue, (float) $request['bank_amount']);
            //     return back()->with(['validation' => true, 'w_method' => $request['w_method'], 'error' => 'Insufficient Funds, try again'])->withInput();
            // }
            if($request['acct_type'] == 'offshore'){
                $withdrawable = $offshore;
                if((float) $request['bank_amount'] > $withdrawable) return back()->with('error', 'Insufficient Funds in your Offshore Account, try again');
            }else{
                $withdrawable = $ira;
                if((float) $request['bank_amount'] > $withdrawable) return back()->with('error', 'Insufficient Funds in your Basic IRA Account, try again');
            }
            if ($user->transactions()->create(['method' => 'bank', 'info' => $request['info'], 'amount' => (float) $request['bank_amount'], 'type' => 'payout', 'actual_amount' => (float) $request['bank_amount'], 'bank_name' => $request['bank_name'], 'acct_name' => $request['acct_name'], 'acct_no' => $request['acct_no'], 'acct_type' => $request['acct_type']])) {
                $msg = 'Withdrawal successful and is pending confirmation';
                // $body = '<p>Your withdrawal of $'.number_format($request['bank_amount'], 2).' was successful. Your withdrawal would be confirmed in a couple of minutes. </p>';
                $body = '<p>Your Bank withdrawal request of $'.number_format($request['bank_amount'], 2).' has been received
                and is in process. We will update the status of your transaction in less than 2/3 working days</p>';
                $mailBody = '<p>A Bank withdrawal request of $'.number_format($request['bank_amount'], 2).' by <b>'.$user->username.'</b> has been received.</p>';
            }
            else
                return back()->with(['validation' => true, 'w_method' => $request['w_method'], 'error' => 'withdrawal was not successful, try again'])->withInput();
        } elseif ($request['w_method'] == 'bitcoin' && $request['w_amount'] > 0) {
            // if($request['w_amount'] > $withdrawable){
            //     return back()->with(['validation' => true, 'w_method' => $request['w_method'], 'error' => 'Insufficient Funds, try again'])->withInput();
            // }

             if($request['acct_type'] == 'offshore'){
                $withdrawable = $offshore;
                if((float) $request['w_amount'] > $withdrawable) return back()->with('error', 'Insufficient Funds in your Offshore Account, try again');
            }else{
                $withdrawable = $ira;
                if((float) $request['w_amount'] > $withdrawable) return back()->with('error', 'Insufficient Funds in your Basic IRA Account, try again');
            }
            $amount = round((float) $request['w_amount'] / AdminController::getBTC(), 8);
            if ($user->transactions()->create(['method' => 'bitcoin','btc_wallet' => $request['btc_wallet'], 'amount' => $amount, 'type' => 'payout', 'actual_amount' => (float) $request['w_amount'], 'acct_type' => $request['acct_type']])) {
                $msg = 'Withdrawal successful and is pending confirmation';
                // $body = '<p>Your withdrawal of $'.(float) $request['w_amount'].' was successful. Your withdrawal would be confirmed in a couple of minutes. </p>';
                $body = '<p>Your Bitcoin withdrawal request of $'.(float) $request['w_amount'].' has been received
                and is in process. We will update the status of your transaction in  less than 24hrs</p>';
                $mailBody = '<p>A Bitcoin withdrawal request of $'.(float) $request['w_amount'].' by <b>'.$user->username.'</b> has been received.</p>';
            }
            else
                return back()->with(['validation' => true, 'method' => $request['w_method'], 'error' => 'withdrawal was not successful, try again'])->withInput();
        } else
            return back()->with(['validation' => true, 'method' => $request['w_method'], 'error' => 'Invalid payment method selected'])->withInput();

        $mail = [
            'name' => $user->name,
            'subject' => 'Withdrawal Request',
            'body' => $body,
            'btc_wallet' => $request['btc_wallet']
        ];

        $adminMail = [
            'subject' => 'Withdrawal Request',
            'body' => $mailBody,
            'btc_wallet' => $request['btc_wallet']
        ];
        // dd($user, $mail);
        MailController::sendRequestWithdrawalNotification($user, $mail);
        $admin = new User;
        $admin['email'] = env('TRANX_EMAIL');
        MailController::sendTransactionNotificationToAdmin($admin, $adminMail);
        return redirect()->route('user.transactions')->with($msg);
    }

    public function attributes()
{
    return [
        'w_method' => 'method',
        'w_amount' => 'amount',
        'acct_type' => 'Account Type'
    ];
}
}
