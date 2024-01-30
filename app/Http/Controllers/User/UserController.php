<?php

namespace App\Http\Controllers\User;

use Exception;
use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Currency;
use App\Models\Document;
use App\Models\Settings;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
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

        $ira_deposit = $user->ira_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $ira_payout = $user->ira_payout()->whereIn('status', ['approved', 'pending'])->sum('actual_amount');
        $offshore_deposit = $user->offshore_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $offshore_payout = $user->offshore_payout()->whereIn('status', ['approved', 'pending'])->sum('actual_amount');
        $ira_roi = $user->ira_roi()->sum('ROI');
        $offshore_roi = $user->offshore_roi()->sum('ROI');
        $offshore = ($offshore_deposit - $offshore_payout) + ($offshore_roi);
        $ira = ($ira_deposit - $ira_payout) + ($ira_roi);

        $portfolioValue = ($ira + $offshore);

        // $percentage =  $portfolioValue > 0 ? ($ira_roi + $offshore_roi) * 100 / ($portfolioValue) : 0;

        //try the %
        $ira_roi_1 = $user->ira_roi()->latest('updated_at')->first();
        $last_ira_roi = $ira_roi_1 ? $ira_roi_1->ROI : 0;

        // $iraPercentage = $ira > 0 ? ($ira - $last_ira_roi)  / ($last_ira_roi) : 0;

        $offshore_roi_1 = $user->offshore_roi()->latest('updated_at')->first();
        $last_offshore_roi = $offshore_roi_1 ? $offshore_roi_1->ROI : 0;

        // $offshorePercentage = $offshore > 0 ? ($offshore - $last_offshore_roi)  / ($last_offshore_roi) : 0;

        // $percentage = $portfolioValue > 0 ? (($portfolioValue) - ($last_offshore_roi + $last_ira_roi)) / ($last_offshore_roi + $last_ira_roi) : 0;
        
        if($portfolioValue > 0 && $last_offshore_roi > 0 && $last_ira_roi > 0)
        {
            $percentage = (($portfolioValue) - ($last_offshore_roi + $last_ira_roi)) / ($last_offshore_roi + $last_ira_roi);
        } else {
            $percentage = 0;
        }

        $jsonFilePath = public_path('crypto.json');

        if (file_exists($jsonFilePath)) {
            $jsonData = file_get_contents($jsonFilePath);
            $data = json_decode($jsonData, true);
        } else {
            $data = null;
        }

        $urlStock = 'https://financialmodelingprep.com/api/v3/quote/AAPL,GOOGL,AMZN,MSFT,TSLA,FB,JPM,V,A,PG,JNJ,MA,NVDA,UNH,BRK.B,HD,DIS,INTC,VZ,PYPL,CMCSA,PFE,ADBE,CRM,XOM,CSCO,IBM,ABT,ACN,BAC,ORCL,COST,TMO,ABBV,NFLX,T,XEL,MDT,NKE,AMGN,CVS,TMUS,DHR,LMT,NEE,HON,BMY,COP?apikey=afc624e3f711729ac7e9d83e211a8dd4';
        
        $res = Http::get($urlStock);
        $stocks_data = $res->json();

        // $stocks_data = self::stock();

        $investment = Investment::query()->where('user_id', auth()->id())->where('status', 'open');
        $stocks = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'stocks')->sum('amount');
        $stocks_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'stocks')->sum('ROI');
        $fixed = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Bonds(Fixed Income)')->sum('amount');
        $fixed_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Bonds(Fixed Income)')->sum('ROI');
        $Properties = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Properties')->sum('amount');
        $Properties_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Properties')->sum('ROI');
        $Cryptocurrencies = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Cryptocurrencies')->sum('amount');
        $Cryptocurrencies_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'Cryptocurrencies')->sum('ROI');
        $gold = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'gold')->sum('amount');
        $gold_roi = Investment::query()->where('user_id', auth()->id())->where('status', 'open')->where('type', 'gold')->sum('ROI');
        $Cash = $investment->where('type', 'Cash')->sum('amount');
        $Cash_roi = $investment->where('type', 'Cash')->sum('ROI');
        $ETF = Investment::query()->where('type', 'ETF’S')->where('user_id', auth()->id())->where('status', 'open')->sum('amount');
        $ETF_roi = Investment::query()->where('type', 'ETF’S')->where('user_id', auth()->id())->where('status', 'open')->sum('ROI');
        $NFT = Investment::query()->where('type', 'NFT’S')->where('user_id', auth()->id())->where('status', 'open')->sum('amount');
        $NFT_roi = Investment::query()->where('type', 'NFT’S')->where('user_id', auth()->id())->where('status', 'open')->sum('ROI');
        $options = Investment::query()->where('type', 'Options')->where('user_id', auth()->id())->where('status', 'open')->sum('amount');
        $options_roi = Investment::query()->where('type', 'Options')->where('user_id', auth()->id())->where('status', 'open')->sum('ROI');

        $assets = [
            'stocks' => ['label' => 'Stocks', 'value' => round($stocks + $stocks_roi, 2), 'color' => "#62d9d7"],
            'fixed' => ['label' => 'Fixed', 'value' => round($fixed + $fixed_roi, 2), 'color' => "#0d1189"],
            'properties' => ['label' => 'properties', 'value' => round($Properties + $Properties_roi, 2), 'color' => "#deb2d2"],
            'crypto' => ['label' => 'Crypto', 'value' => round($Cryptocurrencies + $Cryptocurrencies_roi, 2), 'color' => "#6c96d3"],
            'gold' => ['label' => 'Gold', 'value' => round($gold + $gold_roi, 2), 'color' => "#69382c"],
            'cash' => ['label' => 'Cash', 'value' => round($withdrawable, 2), 'color' => "#90bcbc"],
            'ETF’S' => ['label' => 'ETF’S', 'value' => round($ETF + $ETF_roi, 2), 'color' => "#ef6b6b"],
            'NFT’S' => ['label' => 'NFT’S', 'value' => round($NFT + $NFT_roi, 2), 'color' => "#ffff00"],
            'Options' => ['label' => 'Options', 'value' => round($options + $options_roi, 2), 'color' => "#076262"]
        ];

        $symbol = Currency::where('id', $user->currency_id)->first();
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

        return view('user.index', compact(['user', 'data', 'portfolioValue', 'deposits', 'payouts', 'assets', 'total_assets', 'withdrawable', 'stocks_data', 'symbol', 'percentage']));
    }

    public function portfolio()
    {
        $user = User::find(Auth::id());
        $news = News::query()->orderByDesc('date_range')->get();
        $offshoreData = [];
        $iraData = [];
        $all = request('all');
        $slot = request('slot') == 7 ? 7 : 30;

        $deposits = $user->deposits()->where('status', '=', 'approved')->sum('actual_amount');
        $payouts = $user->payouts()->whereIn('status', ['approved', 'pending'])->sum('actual_amount');
        $closed_roi = $user->investments()->where('status', '=', 'closed')->sum('ROI');
        // dd($closed_roi);
        $open_inv = $user->roi()->where('status', '=', 'open')->sum('amount');
        // $closed_inv = $user->roi()->where('status', '=', 'open')->sum('amount');
        $withdrawable = ($deposits - $payouts - $open_inv) + $closed_roi;
        $data = [];
        $assets = DB::table('investments')
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 'open')
            ->select('type', DB::raw('count(*) as total'), DB::raw('sum(amount) as amount'), DB::raw('sum(ROI) as ROI'))
            ->groupBy('type')
            ->get();
        $cash = $withdrawable;
        $investment = Investment::query();
        $total_amount =
        $total_assets_amount = $investment->where(['user_id' => Auth::id(), 'status' => 'open'])->sum('amount');
        $total_assets_roi = $investment->where(['user_id' => Auth::id(), 'status' => 'open'])->sum('ROI');
        $total_assets = $total_assets_amount + $total_assets_roi + $cash;
        $setting = Settings::first();
        $ira_deposit = $user->ira_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $ira_payout = $user->ira_payout()->whereIn('status', ['approved', 'pending'])->sum('actual_amount');
        $offshore_deposit = $user->offshore_deposit()->where('status', '=', 'approved')->sum('actual_amount');
        $offshore_payout = $user->offshore_payout()->whereIn('status', ['approved', 'pending'])->sum('actual_amount');
        $ira_roi = $user->ira_roi()->sum('ROI');
        $offshore_roi = $user->offshore_roi()->sum('ROI');
        $offshore = ($offshore_deposit - $offshore_payout) + ($offshore_roi);
        $ira = ($ira_deposit - $ira_payout) + ($ira_roi);

        // $iraPercentage = $ira > 0 ? ($ira_roi) * 100 / ($ira) : 0;
        
        // $offshorePercentage = $offshore > 0 ? ($offshore_roi) * 100 / ($offshore) : 0;

        //try the %
        $ira_roi_1 = $user->ira_roi()->latest('updated_at')->first();
        $last_ira_roi = $ira_roi_1 ? $ira_roi_1->ROI : 0;

        // $iraPercentage = $ira > 0 ? ($ira - $last_ira_roi)  / ($last_ira_roi) : 0;
        
        if($ira > 0 && $last_ira_roi > 0)
        {
            $iraPercentage =  ($ira - $last_ira_roi)  / ($last_ira_roi);
        } else {
            $iraPercentage = 0;
        }


        $offshore_roi_1 = $user->offshore_roi()->latest('updated_at')->first();
        $last_offshore_roi = $offshore_roi_1 ? $offshore_roi_1->ROI : 0;

        $offshorePercentage = $offshore > 0 ? ($offshore - $last_offshore_roi)  / ($last_offshore_roi) : 0;

        $days = [];
        if ($all) {
            $diff = now()->diffInMonths(Carbon::make($user['created_at'])) + 1;
            if ($diff > 12) {
                $diff = ceil($diff/12);
                for ($i = 1; $i <= $diff; $i++) {
                    $year = $i == $diff ? now()->format('Y') : now()->subYears($diff - $i)->format('Y');
                    $days[] = $year;

                    $dep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'deposit')
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldDep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'deposit')
                        ->whereDate('created_at', '<', $year.'-01-01')
                        ->sum('actual_amount');
                    $with = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'payout')
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldWith = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'payout')
                        ->whereDate('created_at', '<', $year.'-01-01')
                        ->sum('actual_amount');
                    $roi = $user->investments()
                        ->where('acct_type', 'basic_ira')
                        ->whereYear('created_at', $year)
                        ->sum('ROI');
                    $oldRoi = $user->investments()
                        ->where('acct_type', 'basic_ira')
                        ->whereDate('created_at', '<', $year.'-01-01')
                        ->sum('ROI');
                    $total = ($dep - $with) + $roi;
                    $oldTotal = ($oldDep - $oldWith) + $oldRoi;
                    $iraData[] = round($total + $oldTotal, 2);

                    $dep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'deposit')
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldDep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'deposit')
                        ->whereDate('created_at', '<', $year.'-01-01')
                        ->sum('actual_amount');
                    $with = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'payout')
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldWith = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'payout')
                        ->whereDate('created_at', '<', $year.'-01-01')
                        ->sum('actual_amount');
                    $roi = $user->investments()
                        ->where('acct_type', 'offshore')
                        ->whereYear('created_at', $year)
                        ->sum('ROI');
                    $oldRoi = $user->investments()
                        ->where('acct_type', 'offshore')
                        ->whereDate('created_at', '<', $year.'-01-01')
                        ->sum('ROI');
                    $total = ($dep - $with) + $roi;
                    $oldTotal = ($oldDep - $oldWith) + $oldRoi;
                    $offshoreData[] = round($total + $oldTotal, 2);
                }

            } else {
                for ($i = 1; $i <= $diff; $i++) {
                    $month = $i == $diff ? now()->format('m') : now()->subMonths($diff - $i)->format('m');
                    $year = $i == $diff ? now()->format('Y') : now()->subMonths($diff - $i)->format('Y');
                    $days[] = date('M', strtotime($year.'-'.$month));

                    $dep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'deposit')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldDep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'deposit')
                        ->whereDate('created_at', '<', $year.'-'.$month.'-01')
                        ->sum('actual_amount');
                    $with = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'payout')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldWith = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'basic_ira')
                        ->where('type', 'payout')
                        ->whereDate('created_at', '<', $year.'-'.$month.'-01')
                        ->sum('actual_amount');
                    $roi = $user->investments()
                        ->where('acct_type', 'basic_ira')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('ROI');
                    $oldRoi = $user->investments()
                        ->where('acct_type', 'basic_ira')
                        ->whereDate('created_at', '<', $year.'-'.$month.'-01')
                        ->sum('ROI');
                    $total = ($dep - $with) + $roi;
                    $oldTotal = ($oldDep - $oldWith) + $oldRoi;
                    $iraData[] = round($total + $oldTotal, 2);

                    $dep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'deposit')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldDep = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'deposit')
                        ->whereDate('created_at', '<', $year.'-'.$month.'-01')
                        ->sum('actual_amount');
                    $with = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'payout')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('actual_amount');
                    $oldWith = $user->transactions()
                        ->where('status', 'approved')
                        ->where('acct_type', 'offshore')
                        ->where('type', 'payout')
                        ->whereDate('created_at', '<', $year.'-'.$month.'-01')
                        ->sum('actual_amount');
                    $roi = $user->investments()
                        ->where('acct_type', 'offshore')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('ROI');
                    $oldRoi = $user->investments()
                        ->where('acct_type', 'offshore')
                        ->whereDate('created_at', '<', $year.'-'.$month.'-01')
                        ->sum('ROI');
                    $total = ($dep - $with) + $roi;
                    $oldTotal = ($oldDep - $oldWith) + $oldRoi;
                    $offshoreData[] = round($total + $oldTotal, 2);
                }
            }
        } else {
            for ($i = 1; $i <= $slot; $i++) {
                $day = $i == $slot ? now()->format('Y-m-d') : now()->subDays($slot - $i)->format('Y-m-d');
                $days[] = date('d', strtotime($day));

                $dep = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'basic_ira')
                    ->where('type', 'deposit')
                    ->whereDate('created_at', $day)
                    ->sum('actual_amount');
                $oldDep = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'basic_ira')
                    ->where('type', 'deposit')
                    ->whereDate('created_at', '<', $day)
                    ->sum('actual_amount');
                $with = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'basic_ira')
                    ->where('type', 'payout')
                    ->whereDate('created_at', $day)
                    ->sum('actual_amount');
                $oldWith = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'basic_ira')
                    ->where('type', 'payout')
                    ->whereDate('created_at', '<', $day)
                    ->sum('actual_amount');
                $roi = $user->investments()
                    ->where('acct_type', 'basic_ira')
                    ->whereDate('created_at', $day)
                    ->sum('ROI');
                $oldRoi = $user->investments()
                    ->where('acct_type', 'basic_ira')
                    ->whereDate('created_at', '<', $day)
                    ->sum('ROI');
                $total = ($dep - $with) + $roi;
                $oldTotal = ($oldDep - $oldWith) + $oldRoi;
                $iraData[] = round($total + $oldTotal, 2);

                $dep = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'offshore')
                    ->where('type', 'deposit')
                    ->whereDate('created_at', $day)
                    ->sum('actual_amount');
                $oldDep = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'offshore')
                    ->where('type', 'deposit')
                    ->whereDate('created_at', '<', $day)
                    ->sum('actual_amount');
                $with = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'offshore')
                    ->where('type', 'payout')
                    ->whereDate('created_at', $day)
                    ->sum('actual_amount');
                $oldWith = $user->transactions()
                    ->where('status', 'approved')
                    ->where('acct_type', 'offshore')
                    ->where('type', 'payout')
                    ->whereDate('created_at', '<', $day)
                    ->sum('actual_amount');
                $roi = $user->investments()
                    ->where('acct_type', 'offshore')
                    ->whereDate('created_at', $day)
                    ->sum('ROI');
                $oldRoi = $user->investments()
                    ->where('acct_type', 'offshore')
                    ->whereDate('created_at', '<', $day)
                    ->sum('ROI');
                $total = ($dep - $with) + $roi;
                $oldTotal = ($oldDep - $oldWith) + $oldRoi;

                $offshoreData[] = round($total + $oldTotal, 2);
            }
        }

        $symbol = Currency::where('id', $user->currency_id)->first();

        return view('user.portfolio', compact('symbol', 'last_ira_roi', 'iraPercentage', 'offshorePercentage', 'news', 'user', 'data', 'days', 'assets', 'setting', 'offshore', 'ira', 'iraData', 'offshoreData', 'total_assets', 'cash'));
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
            if ($request['type'] == 'passport') {
                $user['passport'] = $loc;
                $user['id_approved'] = '0';
            }
            if ($request['type'] == 'drivers_license') $user['drivers_license'] = $loc;
            if ($request['type'] == 'state_id') {
                $user['state_id'] = $loc;
                $user['state_id_approved'] = '0';
            }
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
        $notifications->markAsRead();
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
        // // Fetch JSON data from the API
        // $url = 'https://api.coingecko.com/api/v3/simple/price?ids=Bitcoin%2CEthereum%2CBinance%20Coin%2CTether%2CCardano%2CSolana%2CXRP%2CPolkadot%2CShiba%20Inu%2CDogecoin%2CUSD%20Coin%2CTerra%2CUniswap%2CChainlink%2CAvalanche%2CWrapped%20Bitcoin%2CBinance%20USD%2CLitecoin%2CPolygon%2CAlgorand%2CBitcoin%20Cash%2CTRON%2CStellar%2CDecentraland%2CTerraUSD%2CVeChain%2CInternet%20Computer%2CElrond%2CFilecoin%2CCosmos%2CTHETA%2CDai%2CEthereum%20Classic%2CHedera%20Hashgraph%2CFantom%2CNEAR%20Protocol%2CTezos%2CMonero%2CThe%20Graph%2CIOTA%2CEOS%2CKlaytn%2CGala%2CLoopring%2CStacks%2CLEO%20Token%2CAave%2CPancakeSwap%2CFeathercoin%2C1inch%2CIOTA%2CGala%2CAave&vs_currencies=usd&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true&include_last_updated_at=true';
        
        // $response = Http::get($url);

        // // Decode the JSON response
        // $data = $response->json();

        $data = json_decode(file_get_contents(public_path('data.json')), true);
        foreach ($data as $key => $datum)
            if (isset($datum['market_cap']))
                $data[$key]['market_cap'] = self::cap($datum['market_cap']);

                // dd($data);
        return $data;
    }

    public static function stock()
    {
        // $array = ['DXLG', 'IBM', 'TGLS', 'LWLG', 'CAR', 'DDS', 'RRD', 'SGML', 'NOTV', 'CLMT','CAR', 'ZIM', 'SLI'];
        // $base_url = 'https://cloud.iexapis.com/';
        $stocks = [];

        $data = json_decode(file_get_contents(public_path('stock.json')), true);
        foreach ($data as $key => $datum) {
            $data[$key]['marketCap'] = self::cap($datum['marketCap']);
            $data[$key]['logo'] = 'https://storage.googleapis.com/iexcloud-hl37opg/api/logos/'.$datum['symbol'].'.png';
        }
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
            $data = json_decode(Http::get('https://api.coingecko.com/api/v3/simple/price?ids=Bitcoin%2CEthereum%2CBinance%20Coin%2CTether%2CCardano%2CSolana%2CXRP%2CPolkadot%2CShiba%20Inu%2CDogecoin%2CUSD%20Coin%2CTerra%2CUniswap%2CChainlink%2CAvalanche%2CWrapped%20Bitcoin%2CBinance%20USD%2CLitecoin%2CPolygon%2CAlgorand%2CBitcoin%20Cash%2CTRON%2CStellar%2CDecentraland%2CTerraUSD%2CVeChain%2CInternet%20Computer%2CElrond%2CFilecoin%2CCosmos%2CTHETA%2CDai%2CEthereum%20Classic%2CHedera%20Hashgraph%2CFantom%2CNEAR%20Protocol%2CTezos%2CMonero%2CThe%20Graph%2CIOTA%2CEOS%2CKlaytn%2CGala%2CLoopring%2CStacks%2CLEO%20Token%2CAave%2CPancakeSwap%2CFeathercoin%2C1inch%2CIOTA%2CGala%2CAave&vs_currencies=usd&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true&include_last_updated_at=true'), true) ?? [];
            if (count($data) > 1)
                file_put_contents(public_path('data.json'), json_encode($data));
        } catch (Exception $e) {
            dd('Some kind of error');
        }
    }

    public static function updateStock() {
        try {
            $data = json_decode(Http::get('https://cloud.iexapis.com/stable/stock/market/list/mostactive?token=pk_cc0d743e69ec47eeb4a9edf281793933&listLimit=50'), true) ?? [];
            if (count($data) > 1)
                file_put_contents(public_path('stock.json'), json_encode($data));
        } catch (Exception $e) {

        }
    }
}
