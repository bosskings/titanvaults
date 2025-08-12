<?php

namespace App\Http\Controllers;

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
                $user->balance = $balance;
                $user->save();
                return response()->json(['success' => true, 'message' => 'Balance updated successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating balance.',
                'error' => $e->getMessage()
            ], 500);
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

        $toEmail = $request->input('email');
        $subject = $request->input('title');
        $bodyMessage = $request->input('message');

        // Compose the HTML email
        $htmlContent = '
        <div style="background:#f0f6ff;padding:40px 0;">
            <div style="max-width:500px;margin:0 auto;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.07);overflow:hidden;">
                <div style="background:#2563eb;padding:32px 0 16px 0;text-align:center;">
                    <img src="https://titanvaults.org/images/titanvault.png" alt="TitanVault Logo" style="width:80px;height:auto;margin-bottom:12px;">
                    <h2 style="color:#fff;font-size:1.5rem;font-weight:bold;margin:0 0 8px 0;letter-spacing:1px;">' . htmlspecialchars($subject) . '</h2>
                </div>
                <div style="padding:32px 24px 32px 24px;">
                    <div style="color:#1e293b;font-size:1.1rem;line-height:1.7;">
                        ' . nl2br(e($bodyMessage)) . '
                    </div>
                </div>
                <div style="background:#f0f6ff;padding:16px;text-align:center;color:#64748b;font-size:0.95rem;">
                    &copy; ' . date('Y') . ' TitanVault. All rights reserved.
                </div>
            </div>
        </div>
        ';

        try {
            Mail::send([], [], function ($message) use ($toEmail, $subject, $htmlContent) {
                $message->to($toEmail)
                    ->subject($subject)
                    ->setBody($htmlContent, 'text/html');
            });

            return response()->json(['success' => true, 'message' => 'Email sent successfully.']);
        } catch (\Exception $e) {
            Log::error('Error sending custom email: ' . $e->getMessage(), [
                'email' => $toEmail,
                'title' => $subject,
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

}
