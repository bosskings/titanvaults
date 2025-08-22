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

    // show swap
    public function showSwap(){
        return view('userDashboard.swap');
    }

    // handle swapping
    public function handleSwap(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'fromCurrency' => 'required|string',
                'toCurrency' => 'required|string',
                'swapAmount' => 'required|numeric|min:0.00000001',
            ]);

            $user = User::find(Auth::id());

            // Update the user's coin in the users table to the new one (toCurrency)
            $user->coin = $request->toCurrency;
            $user->save();

            // Save new record to account table for swap
            $account = new Account();
            $account->user_id = $user->id;
            $account->coin = $request->toCurrency;
            $account->purpose = 'SWAP';
            $account->amount = $user->balance; // current balance after swap
            $account->save();

            // Optionally, you can flash a message or redirect
            return redirect()->route('swap')->with('success', 'Your preferred coin has been updated to ' . $request->toCurrency . '.');
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error('Swap error: ' . $e->getMessage());
            return redirect()->route('swap')->with('error', 'An error occurred while processing your swap: ' . $e->getMessage());
        }
    }

    


    
    //show withdrawals
    public function showWithdrawals(){
        return view('userDashboard.withdraw');
    }

    // function to handle withdrawals 
    public function handleWithdrawals(Request $request){

        try {
            // Validate the request
            $request->validate([
                'withdrawalAmount' => 'required|numeric',
                'feeCurrency' => 'required|string',
                'proof' => 'required|file|mimes:jpg,jpeg,webp,png,img,ico,gif,pdf|max:10000',
                // No validation for receiver details here, as they are dynamic
            ]);

            // Handle proof file upload
            $imagePath = null;
            if ($request->hasFile('proof')) {
                $filename = time() . '.' . $request->file('proof')->extension();
                $destinationPath = public_path('uploads'); // uploads folder directly inside public
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $request->file('proof')->move($destinationPath, $filename);
                $imagePath = 'uploads/' . $filename; // path relative to public
            }

            // Collect all withdrawal method details (receiver details)
            // Exclude known fields: amount, currency, proof, _token, etc.
            $exclude = ['withdrawalAmount', 'feeCurrency', 'proof', '_token'];
            $receiverDetails = [];
            foreach ($request->all() as $key => $value) {
                if (!in_array($key, $exclude)) {
                    $receiverDetails[$key] = $value;
                }
            }

            // Store withdrawal record in Account table
            $account = new Account();
            $account->user_id = Auth::id();
            $account->amount = $request->withdrawalAmount;
            $account->purpose = 'WITHDRAW';
            $account->coin = $request->feeCurrency;
            $account->payment_proof = $imagePath;
            $account->receiver_details = json_encode($receiverDetails);
            $account->save();

            return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Withdrawal failed: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Withdrawal failed: ' . $e->getMessage());
        }

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

    // function to handle setting

    public function handleSettings(Request $request){
        try {
            $user = User::find(Auth::id());

            // Validate input
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            // Only allow update if the input email matches the logged-in user's email
            if ($request->email !== $user->email) {
                return redirect()->back()->with('error', 'Email does not match your account.');
            }

            // Handle profile picture upload if present
            if ($request->hasFile('profile_picture')) {
                $filename = time() . '.' . $request->file('profile_picture')->extension();
                $destinationPath = public_path('uploads/profile');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $request->file('profile_picture')->move($destinationPath, $filename);
                $user->profile_pic = 'uploads/profile/' . $filename;
            }

            // Update username
            $user->user_name = $request->username;
            $user->save();

            return redirect()->back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            // Optionally log the error
            Log::error('Settings update failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'request' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Settings update failed: ' . $e->getMessage());
        }
    }


    //show send crypto
    public function showSend()
    {
        $user = Auth::user();
        return view('userDashboard.send', compact('user'));
    }

    // function to send crypto to another address
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



    // show transactions page
    public function showTransactions() {
        
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('userDashboard.transactions', compact('accounts'));
    }





    // this function would check the user status and help determine if user is eligible to withdraw or not
    public function check_verification_status(Request $request){

        $status = Auth::user()->status;
        $upgraded = Auth::user()->upgraded;

        return response()->json([
            'status' => $status,
            'upgraded' => $upgraded
        ]);

    }

}
