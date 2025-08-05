<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    // show dashboard
    public function showDashboard(){
        return view('userDashboard.dashboard');
    }

    // show history
    public function showTransactions(){
        return view('userDashboard.transactions');
    }

    //show withdrawals
    public function showWithdrawals(){
        return view('userDashboard.withdraw');
    }

    // show deposit
    public function showDeposit(){
        return view('userDashboard.deposit');
    }
    
    // handle deposit
    public function handleDeposit(Request $request){
        
    }



    // show setting
    public function showSettings(){
        return view('userDashboard.settings');
    }

}
