<?php

use Illuminate\Support\Facades\Route;

// home page
Route::get('/', function(){ return view('index'); })->name('home') ;

// about page
Route::get('/about', function(){    return view('about'); })->name('about');

// contact page 
Route::get('/contact', function(){ return view('contact');})->name('contact');

// login page
Route::get('/login', function(){ return view('login'); })->name('login');

//signup page
Route::get('/register', function(){ return view('register'); })->name('register');



// protected route starts 

// Route::middleware(){
//     Route::get('/dashboard', function(){
//         return view('dashboard');
//     });
    
// }





