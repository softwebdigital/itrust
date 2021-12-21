<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //Host: 41.203.16.246
    //U: lushgetqre
    //P: ob3Sv53L5d3RlVGioK7d
    public function index()
    {
        $admin = auth('admin')->user();
        $deposits = Transaction::query()->where('type', 'deposit')->where('status', '!=', 'declined')->sum('actual_amount');
        $totalDeposits = Transaction::query()->where('type', 'deposit')->where('status', '!=', 'declined')->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . now()->format('t')])->get();
        $payouts = Transaction::query()->where('type', 'payout')->where('status', '!=', 'declined')->sum('actual_amount');
        $totalPayouts = Transaction::query()->where('type', 'payout')->where('status', '!=', 'declined')->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . now()->format('t')])->get();
        $depositArr = $depositData = $payoutArr = $payoutData = $days = [];
        for ($i = 1; $i <= now()->format('t'); $i++) {
            $days[] = $i . now()->format('-M');
            $depositArr[$i] = 0;
            $payoutArr[$i] = 0;
        }
        foreach ($totalDeposits as $deposit) {
            $day = Carbon::make($deposit->created_at)->format('d');
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

    public function deleteUser(User $user)
    {
        if (!$user) return back()->with('error', 'User not found');
        if ($user->delete()) return back()->with('success', 'User deleted successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function userAccountAction(User $user, $action): RedirectResponse
    {
        if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if (!$user) return back()->with('error', 'User not found');
        if ($user->update(['status' => $action])) return back()->with('success', 'User account ' . $action . ' successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function userAccountActionwithBTCWallet(User $user, $action, Request $request): RedirectResponse
    {
        // dd($action);
        $validator = Validator::make($request->all(), [
            'btc_wallet' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first())->withInput();


        if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if (!$user) return back()->with('error', 'User not found');
        if ($user->update(['status' => $action, 'btc_wallet' => $request['btc_wallet']])) return back()->with('success', 'User account ' . $action . ' successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function userBTCWallet(User $user, Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'btc_wallet' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first())->withInput();


        // if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if (!$user) return back()->with('error', 'User not found');
        if ($user->update(['btc_wallet' => $request['btc_wallet']])) return back()->with('success', 'User account Wallet Successfully Updated');
        return back()->with('error', 'An error occurred, try again.');
    }


    public function addTransaction(Request $request, $type)
    {

        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'amount' => 'required',
            'method' => 'required',
            'account' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) return back()->withErrors($validator)->withInput();
        $user_id = $request->input('user');
        $user = User::find($user_id);

        if($type == 'payout'){
        $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
        $inv = $user->roi()->sum('amount');
        $payouts = $user->payouts()->where('status', '=', 'approved')->sum('actual_amount');
        $withdrawable = ($deposits - $payouts) + $inv;
    }

        if ($request['method'] == 'bank') {
            $amount = $request['amount'];
        } else
            $amount = $request['amount'] / 44000;

        $data = [
            'method' => $request['method'],
            'amount' => $amount,
            'actual_amount' => (float) $request['amount'],
            'type' => $type,
            'status' => 'approved',
            'acct_type' => $request['account'],
            'created_at' => $request['date']
        ];

        // if($type == 'payout')
        // if ((float) $request['amount'] > $withdrawable) {
        //     return back()->with(['validation' => true, 'error' => 'Insufficient Funds, try again'])->withInput();
        // }

        if ($user->transactions()->create($data)) {
            return back()->with('success', ucfirst($type) . ' Created Successfully');
        } else
            return back()->with(['validation' => true, 'w_method' => $request['w_method'], 'error' => 'withdrawal was not successful, try again'])->withInput();
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

        if (!Hash::check($request['new_password'], $admin['password']))
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
}
