<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    
    // display registration view
    public function showRegisterForm(){
        return view('register');
    }



    // process registration
    public function register(Request $request){

        try {
            
            
            // validate input
                $request->validate([
                'first_name'=>'required|string|max:50',
                'last_name'=>'required|string|max:50',
                'email'=>'required|email|unique:users',
                'password'=>'required|string|min:8'
            ]);


            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            
            return redirect('/login')->with('mssg', 'Registration Successful, please login');
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Log::error('User registration failed: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Registration failed. ' . $e->getMessage());
        }
    }









    // display login view
    public function showLoginForm(){
        return view('login');
    }



    // process login
    public function login(Request $request){

        try {
            //code...
            
            $details = $request->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]);
            
            
            if(Auth::attempt($details)){
                $request->session()->regenerate();
                return redirect('dashboard');
            }
            
            
            return back()->withErrors([
                'email'=> 'Invalid Credentials',
            ]);
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
        
            Log::error('User Auth failed: ' . $e->getMessage());
        }
        
    }




    // logout system
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


}
