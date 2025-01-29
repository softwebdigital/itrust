<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Currency;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\WebNotification;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;

class InvestmentController extends Controller
{

    public function index()
    {
        $investments = Investment::query()->latest()->paginate(100);
        $users = User::query()->latest()->get();
        return view('admin.investment', compact('investments', 'users'));
    }

    public function create()
    {
        $users = User::query()->orderBy('first_name', 'asc')->get();

        return view('admin.new-inv', compact('users'));
    }

    public function newInvestUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ROI' => 'required|string',
            'status' => 'required',
            'user' => 'required|string',
            'type' => 'required',
            'bot' => 'required',
            'assets' => 'required',
            'acct_type' => 'required|in:basic_ira,offshore',
            'type' => 'required|string|max:255',
            'interval' => 'required|string|max:255',
            'leverage' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'entry' => 'nullable|numeric|min:0',
            'stop' => 'nullable|numeric|min:0',
            'takeprofit' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) return back()->with('error', $validator->errors()->first());

        $user_id = $request['user'];

        $user = User::find($user_id);
        $symbol = Currency::where('id', $user->currency_id)->first();

        $ira_deposit = $user->ira_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $ira_payout = $user->ira_payout()->where('status', '=', 'approved')->sum('actual_amount');
        $offshore_deposit = $user->offshore_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $offshore_payout = $user->offshore_payout()->where('status', '=', 'approved')->sum('actual_amount');
        $ira_roi = $user->ira_roi()->sum('ROI');
        $ira_amount = $user->ira_roi()->sum('amount');
        $offshore_amount = $user->offshore_roi()->sum('amount');
        $offshore_roi = $user->offshore_roi()->sum('ROI');
        $offshore = ($offshore_deposit - $offshore_payout) + ($offshore_roi);
        $ira = ($ira_deposit - $ira_payout) + ($ira_roi);

        if ($request['acct_type'] == 'offshore') {
            // $withdrawable = $offshore;
            $withdrawable = $user->wallet->ot_wallet;
            if ((float) $request['amount'] > $withdrawable) return back()->with('error', 'Insufficient Funds in your Offshore Account, try again');
        } else {
            // $withdrawable = $ira;
            $withdrawable = $user->wallet->it_wallet;
            if ((float) $request['amount'] > $withdrawable) return back()->with('error', 'Insufficient Funds in your Basic IRA Account, try again');
        }

        $amount = 0;

        Investment::create([
            'user_id' => $user_id,
            'amount' => $request['amount'],
            'type' => $request['type'],
            'roi' => (float) $request['ROI'],
            'status' => $request['status'],
            'acct_type' => $request['acct_type'],
            'copy_bot_id' => $request['bot'],
            'asset_type' => $request['assets'],
            'interval' => $request['interval'],
            'leverage' => $request['leverage'],
            'entry_point' => $request['entry'],
            'stop_loss' => $request['stop'],
            'take_profit' => $request['takeprofit'],
        ]);

        $roi = $request['ROI'];

        if ($request['acct_type'] == 'offshore') {
            $user->wallet->increment('balance', $roi);
            $user->wallet->increment('ot_wallet', $roi);
        } else {
            $user->wallet->increment('balance', $roi);
            $user->wallet->increment('it_wallet', $roi);
        }

        $msg = 'You have invested '. $symbol->symbol . $request['amount'];

        $mail = [
            'name' => $user->name,
            'subject' => 'Investment successful',
            'body' => $msg,
        ];

        MailController::sendInvestmentNotification($user, $mail);
        return redirect()->route('admin.investments')->with($msg);
    }

    public function investUser(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $symbol = Currency::where('id', $user->currency_id)->first();
        $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
        $payouts = $user->payouts()->where('status', '=', 'approved')->sum('actual_amount');
        $portfolioValue = $deposits +  $payouts;

        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'type' => 'required',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first());

        if ((float) $request['amount'] > $portfolioValue) return back()->with('error', 'Insufficient Funds, try again');


        $amount = 0;

        $inv = Investment::firstOrNew(['user_id' => $user_id, 'type' => $request['type']]);

        $amount = $inv->amount;

        $inv->amount = (float) $request['amount'] + $amount;

        $inv->save();

        $msg = 'You have invested ' . $symbol->symbol . $request['amount'];

        $mail = [
            'name' => $user->name,
            'subject' => 'Investment successful',
            'body' => $msg,
        ];

        MailController::sendInvestmentNotification($user, $mail);
        return redirect()->route('admin.users')->with($msg);
    }

    public function addTransaction(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'type' => 'required',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first());
        $user = User::find($user_id);
        $symbol = Currency::where('id', $user->currency_id)->first();
        $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
        $payouts = $user->payouts()->where('status', '=', 'approved')->sum('actual_amount');
        $portfolioValue = $deposits +  $payouts;

        if ((float) $request['amount'] > $portfolioValue) return back()->with('error', 'Insufficient Funds, try again');

        $amount = 0;

        $inv = Investment::firstOrNew(['user_id' => $user_id, 'type' => $request['type']]);

        $amount = $inv->amount;

        $inv->amount = (float) $request['amount'] + $amount;

        $inv->save();

        $msg = 'You have invested ' . $symbol->symbol . $request['amount'];

        $mail = [
            'name' => $user->name,
            'subject' => 'Investment successful',
            'body' => $msg,
        ];

        MailController::sendInvestmentNotification($user, $mail);
        return redirect()->route('admin.users')->with($msg);
    }

    public function addRoi(Request $request, $investment_id)
    {
        $investment = Investment::find($investment_id);
        $user = User::find($investment->user_id);
        $acct_type = $investment->acct_type;
        $inv_amount = $investment->amount;

        if ($request['investment'] != $inv_amount) {

            $ira_deposit = $user->ira_deposit()->where('status', '=', 'approved')->sum('actual_amount');
            $ira_payout = $user->ira_payout()->where('status', '=', 'approved')->sum('actual_amount');
            $offshore_deposit = $user->offshore_deposit()->where('status', '=', 'approved')->sum('actual_amount');
            $offshore_payout = $user->offshore_payout()->where('status', '=', 'approved')->sum('actual_amount');
            $ira_roi = $user->ira_roi()->where('status', '=', 'closed')->sum('ROI');
            $ira_amount = $user->ira_roi()->where('status', '=', 'open')->sum('amount');
            $offshore_amount = $user->offshore_roi()->where('status', '=', 'open')->sum('amount');
            $offshore_roi = $user->offshore_roi()->where('status', '=', 'closed')->sum('ROI');
            $offshore = ($offshore_deposit - $offshore_payout) - $offshore_roi - $offshore_amount;
            $ira = ($ira_deposit - $ira_payout) - ($ira_roi + $ira_amount);

            if ($acct_type == 'offshore') {
                $portfolioValue = $offshore;
                if ((float) $request['investment'] > $portfolioValue) return back()->with('error', 'Insufficient Funds in your Offshore Account, try again');
            } else {
                $portfolioValue = $ira;
                if ((float) $request['investment'] > $portfolioValue) return back()->with('error', 'Insufficient Funds in your Basic IRA Account, try again');
            }
        }

        // if((float) $request['investment'] > $portfolioValue) return back()->with('error', 'Insufficient Funds, try again');

        if ($investment->status == 'closed' && $request['status'] == 'closed') return back()->with('error', 'You can\'t update a closed investment');

        if (!$investment) return back()->with('error', 'Investment not found');
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'investment' => 'required|string',
            'status' => 'required|string',
            'type' => 'required|string',
            'assets' => 'required|string',
            'interval' => 'required|string',
            'leverage' => 'required|string',
            'entry' => 'required|numeric',
            'stop' => 'required|numeric',
            'takeprofit' => 'required|numeric',
            'date' => 'required|date',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first());

        // dd(' - ' . $investment['ROI'] . ' and + ' . $request['amount']);

        if ($investment->acct_type == 'offshore') {
            $user->wallet->decrement('balance',$investment['ROI']);
            $user->wallet->decrement('ot_wallet',$investment['ROI']);

            $user->wallet->increment('balance', $request['amount']);
            $user->wallet->increment('ot_wallet', $request['amount']);
        } else {
            $user->wallet->decrement('balance', $investment['ROI']);
            $user->wallet->decrement('it_wallet', $investment['ROI']);
            
            $user->wallet->increment('balance', $request['amount']);
            $user->wallet->increment('it_wallet', $request['amount']);
        }

        if ($investment->update(
            [
                'ROI' => $request['amount'],
                'amount' => $request['investment'],
                'status' => $request['status'],
                'type' => $request['type'],
                'asset_type' => $request['assets'],
                'interval' => $request['interval'],
                'leverage' => $request['leverage'],
                'entry_point' => $request['entry'],
                'stop_loss' => $request['stop'],
                'take_profit' => $request['takeprofit'],
                'created_at' => Carbon::make($request['date'])->format('Y-m-d'),
            ]))

            return back()->with('success', 'Investment successfully updated');

        return back()->with('error', 'An error occurred, try again.');
    }

    public function updateStatus($investment_id, $type)
    {
        $investment = Investment::find($investment_id);
        // dd($investment);

        if ($investment->status == $type) return back()->with('error', 'The Investment is already ' . $type);

        if (!$investment) return back()->with('error', 'Investment not found');

        if ($investment->update(['status' => $type])) {
            $user = User::find($investment->user_id);

            if ($type == 'closed') {
                // if ($investment['acct_type'] == 'offshore') {
                //     $user->wallet->decrement('ot_wallet', $investment['amount']);
                //     $user->wallet->increment('oc_wallet', $investment['amount']);
                // } else {
                //     $user->wallet->decrement('it_wallet', $investment['amount']);
                //     $user->wallet->increment('ic_wallet', $investment['amount']);
                // }

                $data = [
                    'subject' => 'Investment Closed',
                    'body' => '<b>Profit made +$'.number_format($investment['ROI'], 2).' </b>',
                ];
                $user->notify(new WebNotification($data));
            } else {
                // if ($investment['acct_type'] == 'offshore') {
                //     $user->wallet->increment('ot_wallet', $investment['amount']);
                //     $user->wallet->decrement('oc_wallet', $investment['amount']);
                // } else {
                //     $user->wallet->increment('it_wallet', $investment['amount']);
                //     $user->wallet->decrement('ic_wallet', $investment['amount']);
                // }
            }

            return back()->with('success', 'Investment is ' . $type);
        }

        return back()->with('error', 'An error occurred, try again.');
    }


    public function delete($id)
    {
        $investment = Investment::findOrFail($id);
        if ($investment->delete())
            return redirect()->route('admin.investments')->with('success', 'Investment deleted successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }
}
