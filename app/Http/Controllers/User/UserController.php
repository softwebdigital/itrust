<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Investment;
use App\Models\News;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());
        $deposits = $user->deposits()->where('status', 'approved')->sum('actual_amount');
        $payouts = $user->payouts()->where('status', 'approved')->sum('actual_amount');
        $closed_roi = $user->investments()->where('status', 'closed')->sum('ROI');
        // dd($closed_roi);
        $open_inv = $user->roi()->where('status', 'open')->sum('amount');
        // $closed_inv = $user->roi()->where('status', '=', 'open')->sum('amount');
        $withdrawable = ($deposits - $payouts - $open_inv) + $closed_roi;
        // dd($withdrawable);

        // $ira_deposit = $user->ira_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        // $ira_payout = $user->ira_payout()->where('status', '=', 'approved')->sum('actual_amount');
        // $offshore_deposit = $user->offshore_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        // $offshore_payout = $user->offshore_payout()->where('status', '=', 'approved')->sum('actual_amount');
        // $ira_roi = $user->ira_roi()->where('status', '=', 'open')->sum('ROI');
        // $ira_amount = $user->ira_roi()->where('status', '=', 'open')->sum('amount');
        // $offshore_amount = $user->offshore_roi()->where('status', '=', 'open')->sum('amount');
        // $offshore_roi = $user->offshore_roi()->where('status', '=', 'open')->sum('ROI');
        // $offshore = ($offshore_deposit - $offshore_payout) + $offshore_roi + $offshore_amount;
        // $ira = ($ira_deposit - $ira_payout) + $ira_roi + $ira_amount;



        $ira_deposit = $user->ira_deposit()->where('status', 'approved')->sum('actual_amount');
        $ira_payout = $user->ira_payout()->where('status', 'approved')->sum('actual_amount');
        $offshore_deposit = $user->offshore_deposit()->where('status', 'approved')->sum('actual_amount');
        $offshore_payout = $user->offshore_payout()->where('status', 'approved')->sum('actual_amount');
        $ira_roi = $user->ira_roi()->where('status', 'open')->sum('ROI');
        $ira_amount = $user->ira_roi()->where('status', 'open')->sum('amount');
        $offshore_amount = $user->offshore_roi()->where('status', 'open')->sum('amount');
        $offshore_roi = $user->offshore_roi()->where('status', 'open')->sum('ROI');
        $offshore = ($offshore_deposit - $offshore_payout) + $offshore_roi;
        $ira = ($ira_deposit - $ira_payout) + $ira_roi;

        $portfolioValue = ($ira + $offshore);
        // dd($portfolioValue, $withdrawable);
        $data = self::marketCap();
        $stocks_data = self::stock();
        $investment = Investment::query()->where('user_id', auth()->id())->where('status', 'open');
        $stocks = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'stocks')->sum('amount');
        $stocks_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'stocks')->sum('ROI');
        $fixed = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Fixed income(bonds)')->sum('amount');
        $fixed_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Fixed income(bonds)')->sum('ROI');
        $Properties = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Properties')->sum('amount');
        $Properties_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Properties')->sum('ROI');
        $Cryptocurrencies = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Cryptocurrencies')->sum('amount');
        $Cryptocurrencies_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Cryptocurrencies')->sum('ROI');
        $gold = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'gold')->sum('amount');
        $gold_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'gold')->sum('ROI');
        $Cash = $investment->where('type', 'Cash')->sum('amount');
        $Cash_roi = $investment->where('type', 'Cash')->sum('ROI');
        $EFT = Investment::query()->where('type', 'EFT’S')->where('user_id', auth()->id())->where('status', 'open')->sum('amount');
        $EFT_roi = Investment::query()->where('type', 'EFT’S')->where('user_id', auth()->id())->where('status', 'open')->sum('ROI');
        $NFT = Investment::query()->where('type', 'NFT’S')->where('user_id', auth()->id())->where('status', 'open')->sum('amount');
        $NFT_roi = Investment::query()->where('type', 'NFT’S')->where('user_id', auth()->id())->where('status', 'open')->sum('ROI');

        $assets = [
            'stocks' => ['label' => 'Stocks', 'value' => round($stocks + $stocks_roi, 2), 'color' => "#62d9d7"],
            'fixed' => ['label' => 'Fixed', 'value' => round($fixed + $fixed_roi, 2), 'color' => "#0d1189"],
            'properties' => ['label' => 'properties', 'value' => round($Properties + $Properties_roi, 2), 'color' => "#deb2d2"],
            'crypto' => ['label' => 'crypto', 'value' => round($Cryptocurrencies + $Cryptocurrencies_roi, 2), 'color' => "#6c96d3"],
            'gold' => ['label' => 'gold', 'value' => round($gold + $gold_roi, 2), 'color' => "#69382c"],
            'cash' => ['label' => 'cash', 'value' => round($withdrawable, 2), 'color' => "#90bcbc"],
            'EFT’S' => ['label' => 'EFT’S', 'value' => round($EFT + $EFT_roi, 2), 'color' => "#ef6b6b"],
            'NFT’S' => ['label' => 'NFT’S', 'value' => round($NFT + $NFT_roi, 2), 'color' => "#ffff00"]
        ];
//         dd($assets);
//        $new_assets = [];
        foreach ($assets as $key => $asset)
            if ($asset['value'] == 0)
                unset($assets[$key]);
//
//
//        $assets = $new_assets;
//         dd($assets, $new_assets);
        $total_assets = $investment->count();

        return view('user.index', compact(['user', 'data', 'portfolioValue', 'deposits', 'payouts', 'assets', 'total_assets', 'withdrawable', 'stocks_data']));
    }

    public function portfolio()
    {
        $user = User::find(Auth::id());
        $news = News::query()->orderByDesc('date_range')->get();
        $offshoreData = [];
        $iraData = [];

        $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
        $payouts = $user->payouts()->where('status', '=', 'approved')->sum('actual_amount');
        $closed_roi = $user->investments()->where('status', '=', 'closed')->sum('ROI');
        // dd($closed_roi);
        $open_inv = $user->roi()->where('status', '=', 'open')->sum('amount');
        // $closed_inv = $user->roi()->where('status', '=', 'open')->sum('amount');
        $withdrawable = ($deposits - $payouts - $open_inv) + $closed_roi;
        $categories = $data = $days = [];
        $assets = DB::table('investments')
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 'open')
            ->select('type', DB::raw('count(*) as total'), DB::raw('sum(amount) as amount'), DB::raw('sum(ROI) as ROI'))
            ->groupBy('type')
            ->get();
        $cash = $withdrawable;
        $transaction = Transaction::query();
        $investment = Investment::query();
        $total_assets_amount = $investment->where(['user_id' => Auth::id(), 'status' => 'open'])->sum('amount');
        $total_assets_roi = $investment->where(['user_id' => Auth::id(), 'status' => 'open'])->sum('ROI');
        $total_assets = $total_assets_amount + $total_assets_roi + $cash;
        $setting = Settings::first();
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
        // dd($ira, $offshore);
        $payouts = $user->payouts()->where('status', '=', 'approved')->sum('actual_amount');

        $deposits = $transaction->where('acct_type', 'basic_ira')->where('status', '!=', 'declined')->sum('actual_amount');
        $totalDeposits = $transaction->where('acct_type', 'basic_ira')->where('status', '!=', 'declined')->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . (now()->format('d') + 1)])->get();
        $payouts = $transaction->where('acct_type', 'offshore')->where('status', '!=', 'declined')->sum('actual_amount');
        $totalPayouts = $transaction->where('acct_type', 'offshore')->where('status', '!=', 'declined')->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . (now()->format('d') + 1)])->get();

        $depositArr = $depositData = $payoutArr = $payoutData = $days = $full_days = [];
        for ($i = 1; $i <= ((int) now()->format('d')); $i++) {
            $days[] = $i;// . now()->format('-M');
            $full_days[] = now()->format('Y-m-') . (strlen($i) < 2 ? '0'.$i : $i);
        }
        $user_id = $user->id;

        foreach ($full_days as $key => $full_day) {
            $dep = $user->transactions()
                ->where('status', 'approved')
                ->where('acct_type', 'basic_ira')
                ->where('type', 'deposit')
                ->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . ($key + 2)])
                ->sum('actual_amount');
            $with = $user->transactions()
                ->where('status', 'approved')
                ->where('acct_type', 'basic_ira')
                ->where('type', 'payout')
                ->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . ($key + 2)])
                ->sum('actual_amount');
            $roi = $user->investments()
                ->where('acct_type', 'basic_ira')
                ->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . ($key + 2)])
                ->sum('ROI');
            $total = ($dep - $with) + $roi;
            $depositArr[$key] = round($total, 2);
        }

        $amount = self::formatAmount($deposits);
        $depositAmount = $amount[0];
        $depositUnit = $amount[1];
        foreach ($depositArr as $category) $iraData[] = $category;

        $investments = 0;
        $amount = self::formatAmount($investments);
        $investedAmount = $amount[0];
        $investedUnit = $amount[1];

        foreach ($full_days as $key => $full_day) {
            $offshore_dep = $user->transactions()
                ->where('status', 'approved')
                ->where('acct_type', 'offshore')
                ->where('type', 'deposit')
                ->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . ($key + 2)])
                ->sum('actual_amount');
            $offshore_with = $user->transactions()
                ->where('status', 'approved')
                ->where('acct_type', 'offshore')
                ->where('type', 'payout')
                ->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . ($key + 2)])
                ->sum('actual_amount');
            $roi = $user->investments()
                ->where('acct_type', 'offshore')
                ->whereBetween('created_at', [now()->format('Y-m-') . '1', now()->format('Y-m-') . ($key + 2)])
                ->sum('ROI');
            $total = ($offshore_dep - $offshore_with) + $roi;
            $payoutArr[$key] = round($total, 2, );
        }
        foreach ($payoutArr as $arr) $offshoreData[] = $arr;
        $amount = self::formatAmount($payouts);
        $payoutAmount = $amount[0];
        $payoutUnit = $amount[1];
        return view('user.portfolio', compact('news', 'user', 'data', 'days', 'assets', 'setting', 'offshore', 'ira', 'iraData', 'offshoreData', 'total_assets', 'cash'));
    }

    protected static function formatAmount($amount): array
    {
        if (strlen($amount) < 4) {
            $price = $amount;
            $unit = '';
        } elseif (strlen($amount) < 7) {
            $price = $amount / 1000;
            $unit = 'K';
        } elseif (strlen($amount) < 10) {
            $price = $amount / 1000000;
            $unit = 'M';
        } elseif (strlen($amount) < 13) {
            $price = $amount / 1000000000;
            $unit = 'B';
        } else {
            $price = $amount / 1000000000000;
            $unit = 'T';
        }
        return [$price, $unit];
    }

    public function downloadDocument(Document $document): BinaryFileResponse
    {
        return Response::download($document['file']);
    }

    public function uploadDocument(Request $request): JsonResponse
    {
        $user = User::find(Auth::id());
        $validator = Validator::make($request->all(), ['type' => 'required', 'file' => 'required|file|mimes:jpg,png,jpeg|max:1024']);
        if ($validator->fails())
            return response()->json(['msg' => $validator->getMessageBag()], 422);
        if (!in_array($request['type'], ['passport', 'drivers_license', 'state_id']))
            return response()->json(['msg' => 'Invalid file option, refresh the page and try again'], 400);
        if ($file = $request->file('file')) {
            $loc = $file->move('files/' . $request['type'], time() . mt_rand(100, 999) . '.' . $file->getClientOriginalExtension());
            if ($request['type'] == 'passport') $user['passport'] = $loc;
            if ($request['type'] == 'drivers_license') $user['drivers_license'] = $loc;
            if ($request['type'] == 'state_id') $user['state_id'] = $loc;
        }
        if ($user->update())
            return response()->json(['msg' => 'Document uploaded successfully', 'data' => 'Uploaded']);
        return response()->json(['msg' => 'Could not upload file, try again'], 400);
    }

    public function rewards()
    {
        return view('user.rewards');
    }

    public function cash()
    {
        $user = User::find(Auth::id());
        return view('user.cash', compact('user'));
    }

    public function documents()
    {
        $user = User::find(Auth::id());
        $documents = $user->documents()->latest()->get();
        return view('user.documents', compact('user', 'documents'));
    }

    public function settings()
    {
        $user = User::find(Auth::id());
        $devices = self::devices();
        $exp = self::getExperience(Auth::user()['experience']);
        $emp = ucwords(Auth::user()['employment']);
        $ms = ucwords(Auth::user()['marital_status']);
        $yi = self::getYearlyIncome(Auth::user()['yearly_income']);
        $sof = self::getSourceOfFunds(Auth::user()['source_of_funds']);
        $goal = self::getGoal(Auth::user()['goal']);
        $timeline = self::getTimeline(Auth::user()['timeline']);
        $dsp = Auth::user()['dsp'] ? 'Enabled' : 'Disabled';
        return view('user.settings', compact(['user', 'devices', 'exp', 'emp', 'ms', 'yi', 'sof', 'goal', 'timeline', 'dsp']));
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
        $user = User::find(auth()->id());
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'username' => ['required', 'string', Rule::unique('users')->where(function ($q) use ($request) {
                return $q->where('id', '!=', auth()->id())->where('username', $request['username']);
            })],
            'photo' => ['sometimes', 'file', 'mimes:jpg,jpeg,png', 'max:1024']
        ], ['photo.max' => 'Photo must not be greater than 1MB']);
        if ($validator->fails()) return back()->withInput()->withErrors($validator);

        if ($request->file('photo')) {
            $name = $request->file('photo')->getClientOriginalName();
            $user['photo'] = $request->file('photo')->move('img/avatar', $name);
        }

        $user['first_name'] = $request['first_name'];
        $user['last_name'] = $request['last_name'];
        $user['username'] = $request['username'];
        if ($user->update()) return back()->with('success', 'Profile Updated!');
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

    private function _stateCountryIDForCountryName($country_name)
    {
        return DB::table('countries')->where("name", "$country_name")->first()->id;
    }

    public function getState($country_name)
    {
        $country_name = urldecode($country_name);
        $country_id = self::_stateCountryIDForCountryName($country_name);
        $states = DB::table("states")
            ->where("country_id", $country_id)
            ->get('name', 'id');

        return json_encode($states);
    }

    public function signIn(): RedirectResponse
    {
        session()->put('expire_time', '');
        auth()->logout();
        return redirect()->route('login');
    }

    public function updateInvestmentProfile(Request $request, $type): JsonResponse
    {
        $err = null;
        if ($type == 'employment') {
            if (User::find(Auth::id())->update(['employment' => $request['employment']]))
                return response()->json(['msg' => 'Employment Updated', 'data' => ucwords($request['employment'])]);
            else $err = 'Could not update employment';
        }
        if ($type == 'experience') {
            $exp = self::getExperience($request['experience']);
            if (User::find(Auth::id())->update(['experience' => $request['experience']]))
                return response()->json(['msg' => 'Experience Updated', 'data' => $exp]);
            else $err = 'Could not update experience';
        }
        if ($type == 'marital_status') {
            if (User::find(Auth::id())->update(['marital_status' => $request['marital_status']]))
                return response()->json(['msg' => 'Marital Status Updated', 'data' => ucwords($request['marital_status'])]);
            else $err = 'Could not update Marital Status';
        }
        if ($type == 'yearly_income') {
            $yearly_income = self::getYearlyIncome($request['yi']);
            if (User::find(Auth::id())->update(['yearly_income' => $request['yi']]))
                return response()->json(['msg' => 'Yearly Income Updated', 'data' => $yearly_income]);
            else $err = 'Could not update Yearly Income';
        }
        if ($type == 'sof') {
            $sof = self::getSourceOfFunds($request['sof']);
            if (User::find(Auth::id())->update(['source_of_funds' => $request['sof']]))
                return response()->json(['msg' => 'Source of Funds Updated', 'data' => $sof]);
            else $err = 'Could not update Source of Funds';
        }
        if ($type == 'goal') {
            $goal = self::getGoal($request['goal']);
            if (User::find(Auth::id())->update(['goal' => $request['goal']]))
                return response()->json(['msg' => 'Goal Updated', 'data' => $goal]);
            else $err = 'Could not update Goal';
        }
        if ($type == 'timeline') {
            $timeline = self::getTimeline($request['timeline']);
            if (User::find(Auth::id())->update(['timeline' => $request['timeline']]))
                return response()->json(['msg' => 'Timeline Updated', 'data' => $timeline]);
            else $err = 'Could not update Timeline';
        }
        return response()->json(['msg' => $err ?? 'An error occurred, try again'], 400);
    }

    public function updateDSP(Request $request): JsonResponse
    {
        $dsp = $request['dsp'] == 'true';
        if (User::find(Auth::id())->update(['dsp' => $request['dsp'] == 'true'])) return response()->json(['msg' => $dsp ? 'Enabled' : 'Disabled']);
        return response()->json(['msg' => 'Could not Update Data Sharing']);
    }

    public function logoutDevice(Request $request, $id): JsonResponse
    {
        if (Hash::check($request['password'], Auth::user()['password'])) {
            if (DB::table('sessions')->where('id', $id)->where('user_id', Auth::id())->delete())
                return response()->json([
                    'success' => true,
                    'msg' => 'Device removed',
                    'count' => count(self::devices())
                ]);
            return response()->json(['success' => false, 'msg' => 'Could not remove device'], 422);
        } else return response()->json(['success' => false, 'msg' => 'Password is invalid'], 422);
    }

    public function logoutAllDevices(): JsonResponse
    {
        if (DB::table('sessions')->where('user_id', Auth::id())->where('id', '!=', Session::getId())->delete())
            return response()->json(['success' => true, 'msg' => 'Devices removed']);
        return response()->json(['success' => false]);
    }

    public function updateSession(Request $request): JsonResponse
    {
        if (DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', Session::getId())->update([
                'os' => $request['os'],
                'browser' => $request['browser'],
                'location' => $request['loc'],
                'created_at' => $session->created_at ?? now(),
                'updated_at' => $session->updated_at ?? now()
            ])
        ) return response()->json(['success' => true]);
        else return response()->json(['success' => false, 'msg' => 'Not found'], 404);
    }

    protected function devices(): Collection
    {
        return DB::table('sessions')
            ->where('user_id', Auth::id())
            ->get()->reverse();
    }

    public static function marketCap()
    {
        $data = json_decode(file_get_contents(public_path('data.json')), true);
        foreach ($data as $key => $datum)
            $data[$key]['market_cap'] = self::cap($datum['market_cap']);

        // $total=count($data);
        // // dd($total);
        // $per_page = 50;
        // $current_page = $request->input("page") ?? 1;

        // $starting_point = ($current_page * $per_page) - $per_page;

        // $data = array_slice($data, $starting_point, $per_page, true);
        // $data = new Paginator($data, $per_page, $current_page, [
        //     'path' => $request->url(),
        //     'query' => $request->query(),
        // ]);
        // dd($data);
        return $data;
    }

    public static function stock()
    {
        // $array = ['DXLG', 'IBM', 'TGLS', 'LWLG', 'CAR', 'DDS', 'RRD', 'SGML', 'NOTV', 'CLMT','CAR', 'ZIM', 'SLI'];
        // $base_url = 'https://cloud.iexapis.com/';
        $stocks = [];
        // foreach($array as $stock){
        $data = json_decode(file_get_contents(public_path('stock.json')), true);
        // }
//        $data = $data->json();
        // dd($data);
        foreach ($data as $key => $datum) {
            $data[$key]['marketCap'] = self::cap($datum['marketCap']);
//            $symbol = $datum['symbol'];
//            $logo = Http::get("https://cloud.iexapis.com/stable/stock/$symbol/logo?token=pk_cc0d743e69ec47eeb4a9edf281793933"); //&ids=BTC,ETH,XRP
//            $data[$key]['logo'] = $logo->json()['url'];
            $data[$key]['logo'] = 'https://storage.googleapis.com/iexcloud-hl37opg/api/logos/'.$datum['symbol'].'.png';
        }

        // $total=count($data);
        // // dd($total);
        // $per_page = 50;
        // $current_page = $request->input("page") ?? 1;

        // $starting_point = ($current_page * $per_page) - $per_page;

        // $data = array_slice($data, $starting_point, $per_page, true);
        // $data = new Paginator($data, $per_page, $current_page, [
        //     'path' => $request->url(),
        //     'query' => $request->query(),
        // ]);
        // dd($data);
         return $data;
    }

    public static function cap($str): string
    {
        $string = $str;
        if (strlen($str) > 12) {
            $string = number_format($str / 1000000000000, 2) . "T";
        } else if (strlen($str) > 9) {
            $string = number_format($str / 1000000000, 2) . "B";
        } else if (strlen($str)  > 6) {
            $string = number_format($str / 1000000, 2) . "M";
        } else if (strlen($str)  > 3) {
            $string = number_format($str / 1000, 2) . "K";
        }

        return $string;
    }

    public static function getExperience($experience): string
    {
        switch ($experience) {
            case 'beginner':
                $exp = 'Not much';
                break;
            case 'amateur':
                $exp = 'I know what I\'m doing';
                break;
            case 'expert':
                $exp = 'I\'m an expert';
                break;
            default:
                $exp = 'None';
        }
        return $exp;
    }

    public static function getYearlyIncome($yi): string
    {
        switch ($yi) {
            case '25-39':
                $exp = '$25,000 to $39,999';
                break;
            case '40-49':
                $exp = '$40,000 to $49,999';
                break;
            case '50-74':
                $exp = '$50,000 to $74,999';
                break;
            case '75-99':
                $exp = '$75,000 to $99,999';
                break;
            case '100-199':
                $exp = '$100,000 to $199,999';
                break;
            case '200-299':
                $exp = '$200,000 to $299,999';
                break;
            case '300-499':
                $exp = '$300,000 to $499,999';
                break;
            case '400-1199':
                $exp = '$500,000 to $1,199,999';
                break;
            case '1200':
                $exp = '$1,200,000 or higher';
                break;
            default:
                $exp = 'Up to $25,000';
        }
        return $exp;
    }

    public static function getSourceOfFunds($sof): string
    {
        switch ($sof) {
            case 'pension':
                $exp = 'Pension or Retirement';
                break;
            case 'insurance':
                $exp = 'Insurance Payout';
                break;
            case 'inheritance':
                $exp = 'Inheritance';
                break;
            case 'gift':
                $exp = 'Gift';
                break;
            case 'property':
                $exp = 'Sale of Business or Property';
                break;
            case 'something_else':
                $exp = 'Something Else';
                break;
            default:
                $exp = 'Savings or Personal Income';
        }
        return $exp;
    }

    public static function getGoal($goal): string
    {
        switch ($goal) {
            case 'growth':
                $exp = 'Growth';
                break;
            case 'income':
                $exp = 'A source of income';
                break;
            case 'trading':
                $exp = 'Speculation trading';
                break;
            case 'something_else':
                $exp = 'Something Else';
                break;
            default:
                $exp = 'Preserve my savings';
        }
        return $exp;
    }

    public static function getTimeline($timeline): string
    {
        switch ($timeline) {
            case '4-7':
                $exp = '4 to 7 years';
                break;
            case '7':
                $exp = '7 or more years';
                break;
            default:
                $exp = 'Less than 4 years';
        }

        return $exp;
    }

    public static function updateMarketCap() {
        try {
            $data = json_decode(Http::get('https://api.nomics.com/v1/currencies/ticker?key=aba7d7994847e207e4e405132c98374a3c061c5e&interval=1h,1d,30d&convert=USD&per-page=100&page=1&ids=BTC,ETH,BNB,USDT,ADA,SOL,XRP,DOT,SHIB,DOGE,USDC,LUNA,UNI,LINK,AVAX,WBTC,BUSD,LTC,MATIC,ALGO,BCH,TRX,XLM,MANA,UST,VET,ICP,EGLD,FIL,ATOM,THETA,DAI,ETC,HBAR,FTM,NEAR,XTZ,XMR,GRT,MIOTA,EOS,KLAY,GALA,LRC,STX,LEO,AAVE,CAKE,FTETH,1INCH,IOT,GALA,AAVE'), true);
            if (count($data) > 1)
                file_put_contents(public_path('data.json'), json_encode($data));
        } catch (Exception $e) {

        }
    }

    public static function updateStock() {
        try {
            $data = json_decode(Http::get('https://cloud.iexapis.com/stable/stock/market/list/mostactive?token=pk_cc0d743e69ec47eeb4a9edf281793933&listLimit=50'), true);
            if (count($data) > 1)
                file_put_contents(public_path('stock.json'), json_encode($data));
        } catch (Exception $e) {

        }
    }
}
