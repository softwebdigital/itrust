<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chart', function () {
//    $file="C:\Users\DELL\Downloads\CH_Nationality_List_20171130_v1.csv";
//    $csv= file_get_contents($file);
//    $array = array_map("str_getcsv", explode("\n", $csv));
//    $json = json_encode(($array));
//    $json = json_decode($json);
//    $json = array_slice($json, 1, (count($json) - 2));

//    foreach ($json as $value) {
//        \App\Models\Nationality::query()->create(['name' => $value[0]]);
//    }
//    exit();
    return view('chart');
});

Route::get('/cap', function () {
    $data = Http::get('https://api.nomics.com/v1/currencies/ticker?key=aba7d7994847e207e4e405132c98374a3c061c5e&interval=1h,1d,30d&convert=NGNSD&per-page=100&page=1"'); //&ids=BTC,ETH,XRP
    return json_decode($data, true);
});

Route::get('/news', function () {
//    $q = [
//        'category' => 'top',
//        'language' => 'en',
//        'q' => 'bitcoin'
////        'qInTitle' => rawurlencode('ethereum AND bitcoin')
//    ];
//    $data = Http::withHeaders(['X-ACCESS-KEY' => env('NEWS_API_KEY')])
//        ->get('https://newsdata.io/api/1/news', $q);
//    return json_decode($data, true);

    $response = Http::withHeaders([
        'x-rapidapi-key' => 'bcaaef8935msh60e77f09705e368p155434jsn7acf5d45b27f',
        'x-rapidapi-host' => 'cryptosentiment.p.rapidapi.com'
    ])->get('https://cryptosentiment.p.rapidapi.com/');
    return $response;
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get('/admin/password/email', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.email');
Route::post('/admin/password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/admin/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.update');
Route::post('/admin/password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');


Route::get('/lock', [UserController::class, 'lock'])->name('user.lock');
Route::get('/signIn', [UserController::class, 'signIn'])->name('user.signIn');
Route::get('/email/verified', function () {
    return view('auth.verified');
});
Route::group(['middleware' => ['auth', 'lock']], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');
    Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');
    Route::get('/notifications/{id}', [UserController::class, 'showNotification'])->name('user.notifications.show');

    Route::group(['middleware' => 'verified'], function () {
        Route::get('/rewards', [UserController::class, 'rewards'])->name('user.rewards');
        Route::get('/statements', [UserController::class, 'statements'])->name('user.statements');
        Route::get('/transactions', [UserController::class, 'transactions'])->name('user.transactions');
        Route::get('/cash', [UserController::class, 'cash'])->name('user.cash');
        Route::get('/documents', [UserController::class, 'documents'])->name('user.documents');
    });
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/deposits', [AdminController::class, 'deposits'])->name('admin.deposits');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/payouts', [AdminController::class, 'payouts'])->name('admin.payouts');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});
