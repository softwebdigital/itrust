<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = Http::get('https://api.nomics.com/v1/currencies/ticker?key=aba7d7994847e207e4e405132c98374a3c061c5e&interval=1h,1d,30d&convert=NGN&per-page=100&page=1'); //&ids=BTC,ETH,XRP
        $data = json_decode($data, true);
        foreach ($data as $key => $datum) {
            $data[$key]['market_cap'] = $this->cap($datum['market_cap']);
        }
        $q = [
            'category' => 'top',
            'language' => 'en',
            'q' => 'bitcoin'
        ];
        $btcNews = Http::withHeaders(['X-ACCESS-KEY' => env('NEWS_API_KEY')])
            ->get('https://newsdata.io/api/1/news', $q);
        $btcNews = json_decode($btcNews, true);
        $q = [
            'category' => 'top',
            'language' => 'en',
            'q' => 'ethereum'
        ];
        $ethNews = Http::withHeaders(['X-ACCESS-KEY' => env('NEWS_API_KEY')])
            ->get('https://newsdata.io/api/1/news', $q);
        $ethNews = json_decode($ethNews, true);


        return view('user.index', compact('user', 'data', 'btcNews', 'ethNews'));
    }

    public function statements()
    {
        return view('user.statement');
    }

    public function transactions()
    {
        return view('user.transactions');
    }

    public function rewards()
    {
        return view('user.rewards');
    }

    public function cash()
    {
        return view('user.cash');
    }

    public function documents()
    {
        return view('user.documents');
    }

    public function notifications()
    {
        $user = User::find(auth()->id());
        $notifications = $user->notifications;
        if ($notifications->count() < 1) return back();
        $type = 'all';
        return view('user.notifications', compact('notifications', 'type'));
    }

    public function showNotification($id)
    {
        $user = User::find(auth()->id());
        $notification = $user->notifications()->where('id', $id)->first();
        if (!$notification) return back();
        $type = null;
        $notification->markAsRead();
        return view('user.notifications', compact('notification', 'type'));
    }

    public function profile()
    {
        $user = auth()->user();
        $banks = json_decode(Http::get('api.paystack.co/bank'), true);
        $banks = $banks['status'] ? $banks['data'] : [];
        return view('user.profile', compact('user', 'banks'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'username' => ['required', 'string', Rule::unique('users')->where(function ($q) use($request) { return $q->where('id', '!=', auth()->id())->where('username', $request['username']); })],
        ]);
        if ($validator->fails()) return back()->withInput()->withErrors($validator);

        if ($request['photo']) {
            $validator = Validator::make($request->all(), ['photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:1024']], ['photo.max' => 'Photo must not be greater than 1MB']);
            if ($validator->fails()) return back()->withInput()->withErrors($validator);
            $name = $request->file('photo')->getClientOriginalName();
            $user['photo'] = $request->file('photo')->move('user/avatar', $name);
        }

        $user = User::find(auth()->id());
        $user['name'] = $request['name'];
        $user['username'] = $request['username'];
        if ($user->update()) return back()->with('success', 'Password Updated!');
        return back()->with('error', 'An error occurred, try again');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), ['old_password' => 'required|string', 'new_password' => 'required|string|min:8|confirmed']);
        if ($validator->fails()) return back()->withInput()->withErrors($validator);

        $user = User::find(auth()->id());
        if (Hash::check($request['old_password'], $user['password'])) {
            $user['password'] = bcrypt($request['new_password']);
            if ($user->update()) return back()->with('success', 'Password Updated!');
            return back()->with('error', 'An error occurred, try again');
        }
        return back()->withInput()->withErrors(['old_password' => 'Old password is incorrect']);
    }

    public function lock()
    {
        session()->put('expire_time', now());
        return view('auth.passwords.confirm');
    }

    public function signIn(): RedirectResponse
    {
        session()->put('expire_time', '');
        auth()->logout();
        return redirect()->route('login');
    }

    protected function cap($str): string
    {
        $string = $str;
        if (strlen($str) > 12) {
            $string = number_format($str/1000000000000, 2)."T";
        }
        else if (strlen($str) > 9) {
            $string = number_format($str/1000000000, 2)."B";
        }
        else if (strlen($str)  > 6) {
            $string = number_format($str/1000000, 2)."M";
        }
        else if (strlen($str)  > 3) {
            $string = number_format($str/1000, 2)."K";
        }

        return $string;
    }
}
