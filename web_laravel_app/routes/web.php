<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\User_Authentication;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use App\Http\Controllers\UsersDashboardController;
use App\Models\User;

// Route Creates 

Route::get('/', function () {
    return view('index');
});

// User Authentication in Login Page
Route::get('/login', [User_Authentication::class, 'ShowSignin'])->name('login');
Route::post('/dashboard', [User_Authentication::class, 'setcookie'])->name('set.cookie');
Route::post('/dashboard', [User_Authentication::class, 'getcookie'])->name('get.cookie');
// Route to display all users in the dashboard

Route::post('/login', [User_Authentication::class, 'signin'])->name('login.submit');

// Show ALl Users Select Query
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [UsersDashboardController::class, 'showUsers'])->name('dashboard');
// });

// Route::middleware(['auth.cookie'])->group(function () {
//     Route::get('/dashboard', [User_Authentication::class, 'index']);
//     // Add other routes that require authentication and the cookie
// });

// User Authentication in Signup Page

Route::get('/register', [User_Authentication::class, 'ShowRegister'])->name('register');
Route::post('/register', [User_Authentication::class, 'register'])->name('register.submit');

// User Dashboard
Route::get('/dashboard', function () {
    $users = User::all(); // Retrieve all users
    return view('Vendor.dashboard', compact('users')); // Pass data to view
})->middleware('auth')->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/about',function(){
    return view('about');
});

Route::get('/contact',function()
{
    return view('contact');
});

// QueryString 

Route::get('/index/{id}/{name}',function($id,$name){

        return "ID is : " . $id . "  And Name is : " . $name;
});

Route::get('/index/Student',[PostController::class ,'store']);

// Controller through Index Method
Route::get('/index',[PostController::class, 'index']);

// Foreach Result
Route::get('/index/Data',[PostController::class,'show']);