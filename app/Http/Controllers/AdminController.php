<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Pass the multi-dimensional array to the view
        return view('adminDashboard.index', [
            'usersWithAccounts' => $usersWithAccounts
        ]);
    }

    

}
