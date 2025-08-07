<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
                'proof' => 'required|file|mimes:jpg,jpeg,webp,png,img,ico,gif,pdf|max:10000'
            ]);

            $account = Account::where('user_id', Auth::id())->first();

            $imagePath = null;
            // get picture proof and add
            if ($request->hasFile('proof')) {
                $filename = time() . '.' . $request->file('proof')->extension();
                $imagePath = $request->file('proof')->storeAs('uploads', $filename, 'public');
            }

            if (!$account) {
                // No account for this user, create one
                $account = new Account();
                $account->user_id = Auth::id();
                $account->balance = $request->amount;
                $account->coin = $request->currency;
                $account->payment_proof = $imagePath;
                $account->save();
            } else {
                // Update the existing account record with new deposit
                $account->balance += $request->amount;
                $account->coin = $request->currency;
                $account->payment_proof = $imagePath;
                $account->save();
            }

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
