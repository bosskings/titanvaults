<?php

use App\Http\Controllers\AdminContoller;
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


Route::get('/Admin-encrypt-formal-8987823', [AdminController::class, 'showAdmin'])->name('Admin');

// Authenticated Routes
Route::middleware('auth')->group(function(){
    
    
    // for dashboard
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');


    // for history
    Route::get('/history', [DashboardController::class, 'showHistory'])->name('history');


    // for deposit
    Route::get('/deposit', [DashboardController::class, 'showDeposit'])->name('deposit');

    // for withdraw
    Route::get('/withdraw', [DashboardController::class, 'showWithdrawals'])->name('withdraw');

    // for settings
    Route::get('/settings', [DashboardController::class, 'showSettings'])->name('setting');

    // for transactions
    Route::get('/transactions', [DashboardController::class, 'showTransactions'])->name('transaction');


    // for logout
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

});

// require __DIR__.'/auth.php';
