<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
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

//FE
Route::get('/', [FrontEndController::class, 'home'])->name('frontend.home');
Route::get('/stocks-and-funds', [FrontEndController::class, 'stocks'])->name('frontend.stocks');
Route::get('/crypto', [FrontEndController::class, 'crypto'])->name('frontend.crypto');
Route::get('/gold', [FrontEndController::class, 'gold'])->name('frontend.gold');
Route::get('/options', [FrontEndController::class, 'options'])->name('frontend.options');
Route::get('/investor-relations', [FrontEndController::class, 'investor_relations'])->name('frontend.investor_relations');
Route::get('/our-commitments', [FrontEndController::class, 'commitments'])->name('frontend.commitments');
Route::get('/about', [FrontEndController::class, 'about'])->name('frontend.about');
Route::get('/blog', [FrontEndController::class, 'blog'])->name('frontend.blog');
Route::get('/blog/{blog:slug}', [FrontEndController::class, 'blogview'])->name('frontend.blogview');
Route::post('/comment/add/{blog:slug}', [FrontEndController::class, 'addComment'])->name('frontend.blog.addcomment');
Route::get('/privacy', [FrontEndController::class, 'privacy'])->name('frontend.privacy');
Route::get('/terms-and-conditions', [FrontEndController::class, 'terms'])->name('frontend.terms');
Route::get('/faq', [FrontEndController::class, 'faq'])->name('frontend.faq');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('frontend.contact');
Route::get('/how-to-invest', [FrontEndController::class, 'invest'])->name('frontend.invest');
Route::get('/cash-management', [FrontEndController::class, 'cash'])->name('frontend.cash');

Route::post('/image/upload', [AdminController::class, 'imageUpload'])->name('image.upload');

Route::get('/cap', [UserController::class, 'marketCap'])->name('cap');

Auth::routes(['verify' => true]);
Route::get('/email/change', [VerificationController::class, 'changeEmail']);
Route::post('/email/change', [VerificationController::class, 'postChangeEmail'])->name('change.email');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/alt/login', [HomeController::class, 'showLogin'])->name('altLogin');
Route::post('/alt/login', [HomeController::class, 'login'])->name('altLogin');
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get('/admin/password/email', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.email');
Route::post('/admin/password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/admin/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.update');
Route::post('/admin/password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');


Route::get('/lock', [UserController::class, 'lock'])->name('user.lock');
Route::get('/getStates/{name}', [UserController::class, 'getState'])->name('user.getstate');
Route::get('/signIn', [UserController::class, 'signIn'])->name('user.signIn');
Route::get('/email/verified', function () {
    return view('auth.verified');
});
Route::group(['middleware' => ['auth', 'lock']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');
    Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');
    Route::get('/notifications/{id}', [UserController::class, 'showNotification'])->name('user.notifications.show');
    Route::post('/devices/update', [UserController::class, 'updateSession'])->name('user.devices.update');
    Route::delete('/devices/{id}/destroy', [UserController::class, 'logoutDevice'])->middleware('throttle:3,1');
    Route::post('/dsp', [UserController::class, 'updateDSP'])->middleware('throttle:3,1');
    Route::post('/profile/investment/{type}/update', [UserController::class, 'updateInvestmentProfile'])->middleware('throttle:8,1');

    Route::group(['middleware' => 'verified'], function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.index');
        Route::get('/portfolio', [UserController::class, 'portfolio'])->name('user.portfolio')->middleware('approved');
        Route::get('/documents/{document}/download', [UserController::class, 'downloadDocument'])->name('user.documents.download');
        Route::post('/portfolio', [UserController::class, 'uploadDocument'])->name('user.documents.upload')->middleware('throttle:3,1');

        Route::get('/rewards', [UserController::class, 'rewards'])->name('user.rewards');
        Route::get('/statements', [TransactionController::class, 'userStatements'])->name('user.statements')->middleware('approved');
        Route::get('/statements/pdf', [TransactionController::class, 'createStatementsPDF']);
        Route::get('/transactions', [TransactionController::class, 'userTransactions'])->name('user.transactions')->middleware('approved');
        Route::put('/transactions/{transaction}/action/{action}', [TransactionController::class, 'transactionAction'])->name('user.transactions.action')->middleware('approved');
        Route::get('/transactions/pdf', [TransactionController::class, 'createHistoryPDF']);
        Route::get('/invoice/pdf/{type}', [TransactionController::class, 'createInvoicePDF']);

        Route::get('/cash', [UserController::class, 'cash'])->name('user.cash')->middleware('approved')->middleware('approved');
        Route::get('/cash/deposit', [TransactionController::class, 'deposit'])->name('user.deposit')->middleware('approved');
        Route::post('/cash/deposit/post', [TransactionController::class, 'userDepositStore'])->name('user.deposit.store')->middleware('approved');
        Route::get('/cash/withdraw', [TransactionController::class, 'withdraw'])->name('user.withdraw')->middleware('approved');
        Route::post('/cash/withdraw/post', [TransactionController::class, 'userWithdrawStore'])->name('user.withdraw.store')->middleware('approved');

        Route::get('/invoices', [UserController::class, 'invoices'])->name('user.invoices')->middleware('approved');
        Route::post('/invoices', [UserController::class, 'storeInvoice'])->name('user.invoices.store');

        Route::get('/documents', [UserController::class, 'documents'])->name('user.documents')->middleware('approved');
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
    });
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{user}', [AdminController::class, 'user'])->name('admin.users.show');
    Route::put('/users/{user}/account/{action}', [AdminController::class, 'userAccountAction'])->name('admin.users.account');
    Route::put('/users/{user}/account/{action}/withBtc', [AdminController::class, 'userAccountActionwithBTCWallet'])->name('admin.users.accountBtcWallet');
    Route::put('/users/{user}/wallet/account', [AdminController::class, 'userBTCWallet'])->name('admin.users.userBTCWallet');
    Route::post('/users/invest', [InvestmentController::class, 'investUser'])->name('admin.users.invest');
    Route::post('/users/add_transaction/{type}', [AdminController::class, 'addTransaction'])->name('admin.users.addtransaction');
    Route::put('/transactions/{id}/update/{type}', [AdminController::class, 'editTransaction'])->name('admin.transactions.edit');
    Route::post('/users/invest/new', [InvestmentController::class, 'newInvestUser'])->name('admin.users.newInvest');
    Route::post('/users/update/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/users/delete/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/users/{user}/documents/{action}', [AdminController::class, 'approveID'])->name('admin.users.documents.action');

    Route::get('/deposits', [TransactionController::class, 'deposits'])->name('admin.deposits');
    Route::put('/deposits/{transaction}/{action}', [TransactionController::class, 'depositAction'])->name('admin.deposits.action');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions');

    Route::get('/payouts', [TransactionController::class, 'payouts'])->name('admin.payouts');
    Route::put('/payouts/{transaction}/{action}', [TransactionController::class, 'payoutAction'])->name('admin.payouts.action');

    Route::put('/transaction/{transaction}/{action}', [TransactionController::class, 'generalAction'])->name('admin.transaction.action');

    Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
    Route::get('/news/add', [NewsController::class, 'create'])->name('admin.news.create');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::post('/news/store', [NewsController::class, 'store'])->name('admin.news.store');
    Route::put('/news/{news}/update', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}/destroy', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    Route::get('/blogs', [BlogController::class, 'index'])->name('admin.blog');
    Route::get('/blogs/add', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::post('/blogs/{blog}/update', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/blogs/{blog}/destroy', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

    Route::get('/blogcategory', [BlogCategoryController::class, 'index'])->name('admin.blogCategory');
    Route::get('/blogcategory/add', [BlogCategoryController::class, 'create'])->name('admin.blogCategory.create');
    Route::post('/blogcategory/store', [BlogCategoryController::class, 'store'])->name('admin.blogCategory.store');
    Route::post('/blogcategory/update/{id}', [BlogCategoryController::class, 'update'])->name('admin.blogCategory.update');
    Route::delete('/blogcategory/{id}/destroy', [BlogCategoryController::class, 'destroy'])->name('admin.blogCategory.destroy');

    Route::get('/documents', [DocumentController::class, 'index'])->name('admin.documents');
    Route::post('/documents', [DocumentController::class, 'store'])->name('admin.documents.store');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('admin.documents.update');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('admin.documents.destroy');

    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.post');

    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile/password', [AdminController::class, 'updatePassword'])->name('admin.password.update');

    Route::get('/investments', [InvestmentController::class, 'index'])->name('admin.investments');
    // Route::get('/investments/add', [InvestmentController::class, 'create'])->name('admin.inv.create');
    Route::post('/investments/addroi/{id}', [InvestmentController::class, 'addRoi'])->name('admin.investments.addroi');
    Route::get('/investments/{id}/action/{type}', [InvestmentController::class, 'updateStatus'])->name('admin.investments.updatestatus');
    Route::post('/investments/delete/{id}', [InvestmentController::class, 'delete'])->name('admin.investments.delete');
});
