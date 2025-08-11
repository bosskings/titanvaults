<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    
    // show dashboard
    public function showDashboard(){

        // get all the details from the users table and return to the view
        $user = Auth::user();
        
        // error_log(json_encode($user));
        return view('userDashboard.dashboard', ['user' => $user]);


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

            // $account = Account::where('user_id', Auth::id())->first();

            $imagePath = null;
            // get picture proof and add
            if ($request->hasFile('proof')) {
                $filename = time() . '.' . $request->file('proof')->extension();
                $destinationPath = public_path('uploads');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $request->file('proof')->move($destinationPath, $filename);
                $imagePath = 'uploads/' . $filename;
            }

            
            // store record
            $account = new Account();
            $account->user_id = Auth::id();
            $account->amount = $request->amount;
            $account->purpose = 'DEPOSIT';
            $account->coin = $request->currency;
            $account->payment_proof = $imagePath;
            $account->save();
        

            return redirect()->back()->with('success', 'Deposit successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Deposit failed: ' . $e->getMessage());
       
            // Log the error message to storage/logs/laravel.log
            
            Log::error('Deposit failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'request' => $request->all()
            ]);
        }
    }



    // show setting
    public function showSettings(){
        return view('userDashboard.settings');
    }




    //show send crypto
    public function showSend()
    {
        $user = Auth::user();
        return view('userDashboard.send', compact('user'));
    }



    // function to send crypto to another address
    // Function to send dummy crypto to another address
    public function handleSend(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.00000001',
                'coin' => 'required|string|max:10',
                'receiver_address' => 'required|string|max:255',
            ]);

            // Store details of this transaction in the accounts table with purpose = 'SEND'
            $account = new Account();
            $account->user_id = Auth::id();
            $account->coin = strtoupper($request->coin);
            $account->amount = $request->amount;
            $account->wallet_address = $request->receiver_address;
            $account->purpose = 'SEND';
            $account->save();

            // Simulate processing (in real app, you'd queue or process the transaction)
            return redirect()->back()->with('success', 'Send transaction submitted successfully.');
        } catch (\Exception $e) {
            // Optionally log the error here
            Log::error('Send transaction failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'request' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Send transaction failed: ' . $e->getMessage());
        }
    }

}
