<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BankTransferController;
use App\Http\Controllers\Admin\DeporitController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SendMoneyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;




Route::get('/cmd',function(){
    Artisan::call('storage:link');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return 'Done';
});



Route::get('/', [WebsiteController::class, 'home'])->name('index');



// Auth::routes(['verify' => true]);




// Route::middleware(['auth', 'no.admin', 'verified'])->group(function () {
//     Route::get('/home', function () {
//         return view('home');
//     })->name('home');

//     Route::get('settings', [HomeController::class, 'settings'])->name('user.settings');
//     Route::get('profile', [HomeController::class, 'profile'])->name('user.profile');
//     Route::get('profile/edit', [HomeController::class, 'profileEdit'])->name('user.profile.edit');
//     Route::put('/profile/update', [HomeController::class, 'update'])->name('user.profile.update');
//     Route::get('password/edit', [HomeController::class, 'passwordEdit'])->name('user.password.edit');
//     Route::post('/password-update', [HomeController::class, 'updatePassword'])->name('user.password.update');
// });



// Admin Auth
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::prefix('admin')
    // ->middleware(['auth:admin', 'admin.only', 'role:super-admin'])
    ->middleware(['auth:admin', 'admin.only', 'admin.has.role'])
    ->name('admin.')
    ->group(function () {


        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/profile/settings', [AdminProfileController::class, 'settings'])->name('profile.settings');
        Route::put('/profile/settings', [AdminProfileController::class, 'updateSettings'])->name('profile.settings.update');

        Route::get('/change-password', [AdminProfileController::class, 'changePassword'])->name('change.password');
        Route::put('/change-password', [AdminProfileController::class, 'updatePassword'])->name('change.password.update');


        Route::resource('settings', SettingController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        //Account
        Route::resource('accounts', AccountController::class,);
        Route::post('accounts/status-update', [AccountController::class, 'updateStatus'])->name('accounts.status.update');

        
        //Deposit
        Route::resource('deposit', DeporitController::class,);
        Route::post('deposit/status-update', [DeporitController::class, 'updateStatus'])->name('deposit.status.update');

        //Sendmoney
        Route::resource('send-money', SendMoneyController::class,);
        Route::post('send-money/status-update', [SendMoneyController::class, 'updateStatus'])->name('send-money.status.update');

        //Bank  Transfer
        Route::resource('bank-transfer', BankTransferController::class,);
        Route::post('bank-transfer/status-update', [BankTransferController::class, 'updateStatus'])->name('bank-transfer.status.update');

        //Withdraw
        Route::resource('withdraw', WithdrawController::class,);
        Route::post('withdraw/status-update', [WithdrawController::class, 'updateStatus'])->name('withdraw.status.update');



    });


// php artisan migrate:refresh --path=database/migrations/2025_05_12_061213_create_dps_members_table.php
