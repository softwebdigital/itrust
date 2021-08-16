<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $totalDeposits = Transaction::query()->where('type', 'deposit')->where('status', '!=', 'declined')->whereBetween('created_at', [now()->format('Y-m-').'1', now()->format('Y-m-').now()->format('t')])->get();
        $payouts = Transaction::query()->where('type', 'payout')->where('status', '!=', 'declined')->sum('actual_amount');
        $totalPayouts = Transaction::query()->where('type', 'payout')->where('status', '!=', 'declined')->whereBetween('created_at', [now()->format('Y-m-').'1', now()->format('Y-m-').now()->format('t')])->get();
        $depositArr = $depositData = $payoutArr = $payoutData = $days = [];
        for ($i = 1; $i <= now()->format('t'); $i++) {
            $days[] = $i.now()->format('-M');
            $depositArr[$i] = 0;
            $payoutArr[$i] = 0;
        }
        foreach ($totalDeposits as $deposit) {
            $day = Carbon::make($deposit->created_at)->format('d');
            if (array_key_exists($day, $depositArr)) {
                $depositArr[$day] = $depositArr[$day] + $deposit->actual_amount;
            } else $depositArr[$day] = $deposit->actual_amount;
        }
        $deposits = $this->formatAmount($deposits);
        $depositAmount = $deposits[0];
        $depositUnit = $deposits[1];
        foreach ($depositArr as $category) $depositData[] = $category;

        $investments = $this->formatAmount(0);
        $investedAmount = $investments[0];
        $investedUnit = $investments[1];

        foreach ($totalPayouts as $payout) {
            $day = Carbon::make($payout->created_at)->format('d');
            if (array_key_exists($day, $payoutArr)) {
                $payoutArr[$day] = $payoutArr[$day] + $payout->actual_amount;
            } else $payoutArr[$day] = $payout->actual_amount;
        }
        foreach ($payoutArr as $arr) $payoutData[] = $arr;
        $payouts = $this->formatAmount($payouts);
        $payoutAmount = $payouts[0];
        $payoutUnit = $payouts[1];

        return view('admin.index', compact(['admin', 'depositData', 'days', 'depositAmount', 'depositUnit', 'payoutAmount', 'payoutUnit', 'payoutData', 'investedAmount', 'investedUnit']));
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

    public function userAccountAction(User $user, $action): RedirectResponse
    {
        if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if (!$user) return back()->with('error', 'User not found');
        if ($user->update(['status' => $action])) return back()->with('success', 'User account '.$action.' successfully');
        return back()->with('error', 'An error occurred, try again.');
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
            $name = time().$image->getClientOriginalName();
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
        $admin = auth('admin')->user();
        return view('admin.settings', compact('admin'));
    }

    protected function formatAmount($amount): array
    {
        if (strlen($amount) < 4) {
            $price = $amount;
            $unit = '';
        }
        elseif (strlen($amount) > 3 && strlen($amount) < 7) {
            $price = $amount/1000;
            $unit = 'K';
        }
        elseif (strlen($amount) > 6 && strlen($amount) < 10) {
            $price = $amount/1000000;
            $unit = 'M';
        }
        elseif (strlen($amount) > 9 && strlen($amount) < 13) {
            $price = $amount/1000000000;
            $unit = 'B';
        }
        else {
            $price = $amount/1000000000000;
            $unit = 'T';
        }
        return [$price, $unit];
    }
}
