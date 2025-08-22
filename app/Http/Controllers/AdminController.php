<?php

namespace App\Http\Controllers;

use App\Mail\AdminEmail;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    
    // display all users on the admin 

    public function showAdmin(){
        
        // get all users and their accounts in a multi-dimensional array
        $usersWithAccounts = [];

        $users = User::all();

        foreach ($users as $user) {
            // Get all accounts for this user
            $accounts = Account::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

            // Build a user array with user fields and an 'accounts' key
            $userArray = $user->toArray();

            $userArray['accounts'] = $accounts->isEmpty() ? "NO Transaction" : $accounts->toArray();

            $usersWithAccounts[] = $userArray;
        }

        error_log(json_encode($usersWithAccounts));

        // Pass the multi-dimensional array to the view
        return view('adminDashboard.index', [
            'usersWithAccounts' => $usersWithAccounts
        ]);
    }




    // function to allow admin approve account activity
    public function approve_activity(Request $request){

        $account_id = $request->input('id');

        // Find the account by id and update its status to 'seen'
        $account = Account::find($account_id);
        if ($account) {
            $account->status = 'seen';
            $account->save();
            return response()->json(['success' => true, 'message' => 'Status updated to seen.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Account not found.'], 404);
        }
        

    }


    // function to allow admin change balance
    public function change_balance(Request $request){

        $user_id = $request->input('user_id');
        $balance = $request->input('amount');

        try {
            // Find the user by id and update their balance
            $user = User::find($user_id);

            if ($user) {
                // Format the balance as comma separated with two decimals (e.g., 1,234.00)
                $balance = number_format((float)$balance, 2, '.', ',') ;
                $user->balance = (string) $balance;
                $user->save();
                return response()->json(['success' => true, 'message' => 'Balance updated successfully.']);
            } else {
                return response()->json(['error' => false, 'message' => 'User not found.'], 404);
            }
        } catch (\Exception $e) {

            error_log( $e->getMessage() );

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating balance.',
                'error' => $e->getMessage()
            ], 500);


            Log::error("Error updating balance",  [
                'success' => false,
                'message' => 'An error occurred while updating balance.',
                'error' => $e->getMessage()  
            ]);
        }

    }



    // function to change user verification status
    public function change_status(Request $request){

        $user_id = $request->input('user_id');
        $status = $request->input('status');

        // Find the user by id and update their status
        $user = User::find($user_id);

        if ($user) {
            $user->status = $status;
            $user->save();
            return response()->json(['success' => true, 'message' => 'User status updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }


    }



    // function to change user verification status
    public function change_upgraded(Request $request){

        $user_id = $request->input('user_id');
        $upgraded = $request->input('upgraded');

        // Find the user by id and update their status
        $user = User::find($user_id);

        if ($user) {
            $user->upgraded = $upgraded;
            $user->save();
            return response()->json(['success' => true, 'message' => 'User upgraded successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }


    }



    // function to suspend users
    public function suspend_user(Request $request){

        $user_id = $request->input('user_id');
        $status = $request->input('status');

        // Find the user by id and update their status
        try {
            $user = User::find($user_id);

            if ($user) {
                $user->deleted = $status;
                $user->save();
                return response()->json(['success' => true, 'message' => 'User status updated successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found.'], 404);
            }
        } catch (\Exception $e) {
            
            Log::error('Error suspending user: ' . $e->getMessage(), [
                'user_id' => $user_id,
                'status' => $status,
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while suspending user.',
                'error' => $e->getMessage()
            ], 500);
        }


    }



    // send emails..
    public function admin_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $recipientEmail = $request->input('email');
        $emailTitle = $request->input('title');
        $emailMessage = $request->input('message');
        
        try {
            // Send the Mailable 
            Mail::to($recipientEmail)->send(new AdminEmail($recipientEmail, $emailTitle, $emailMessage));

            return response()->json(['success' => true, 'message' => 'Email sent successfully!']);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Failed to send admin email: ' . $e->getMessage(), [
                'recipient' => $recipientEmail,
                'title' => $emailTitle,
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to send email. Please try again later.'], 500);
        }
    }
    

}
