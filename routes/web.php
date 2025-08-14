<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// home page
Route::get('/', function(){ return view('index'); })->name('home') ;

// about page
Route::get('/about', function(){ return view('about'); })->name('about');

// contact page 
Route::get('/contact', function(){ return view('contact');})->name('contact');

// login page
Route::get('/login', [AuthenticationController::class, 'showLoginForm'] )->name('login');
Route::post('/login',[AuthenticationController::class, 'login'] );

//signup page
Route::get('/register', [AuthenticationController::class, 'showRegisterForm'] )->name('register');
Route::post('/register', [AuthenticationController::class, 'register'] );


// admin section starts
Route::get('/Admin-encrypt-formal-8987823', [AdminController::class, 'showAdmin'])->name('Admin');
Route::post('/admin_email', [AdminController::class, 'admin_email'])->name('admin_email');

Route::get('/approve_activity', [AdminController::class, 'approve_activity'])->name('approve_activity');
Route::get('/change_balance', [AdminController::class, 'change_balance'])->name('change_balance');
Route::get('/change_status', [AdminController::class, 'change_status'])->name('change_status');
Route::get('/suspend_user', [AdminController::class, 'suspend_user'])->name('suspend_user');


// Authenticated Routes
Route::middleware(['auth'])->group(function(){
    
    // for dashboard
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');


    // for swap
    Route::get('/swap', [DashboardController::class, 'showSwap'])->name('swap');
    Route::post('/swap', [DashboardController::class, 'handleSwap'])->name('swap');

    // for deposit
    Route::get('/deposit', [DashboardController::class, 'showDeposit'])->name('deposit');
    Route::post('/deposit', [DashboardController::class, 'handleDeposit'])->name('deposit');
    
    // for withdraw
    Route::get('/withdraw', [DashboardController::class, 'showWithdrawals'])->name('withdraw');
    Route::post('/withdraw', [DashboardController::class, 'handleWithdrawals'])->name('withdraw');
    
    // for sending crypto
    Route::get('/send', [DashboardController::class, 'showSend'])->name('send');
    Route::post('/send', [DashboardController::class, 'handleSend'])->name('send');

    // for settings
    Route::get('/settings', [DashboardController::class, 'showSettings'])->name('setting');
    Route::post('/settings', [DashboardController::class, 'handleSettings'])->name('setting');

    // for transactions
    Route::get('/transactions', [DashboardController::class, 'showTransactions'])->name('transaction');
    

    // for logout
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

});

// require __DIR__.'/auth.php';
