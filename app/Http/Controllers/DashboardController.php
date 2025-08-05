<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function handleDeposit(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric',
                'currency' => 'required|string',
            ]);

            $user = Auth::user() ? User::find(Auth::id()) : null;

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            $user->balance += $request->amount;
            $user->coin = $request->currency;
            $user->save();

            return redirect()->back()->with('success', 'Deposit successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Deposit failed: ' . $e->getMessage());
        }
    }



    // show setting
    public function showSettings(){
        return view('userDashboard.settings');
    }

}
