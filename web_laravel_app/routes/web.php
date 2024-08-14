<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\User_Authentication;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use App\Http\Controllers\UsersDashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin_Dashboard;
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

// Forget_Password
Route::get('/forget_password', function () {
    return view('Vendor.forget_password');
})->name('password.forget');

Route::post('/forget_password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route to handle the password reset link request
Route::post('/forget_password', [ResetPasswordController::class, 'store'])
    ->name('password.email');

// Reset Password user
// Route to show the password reset form
Route::get('reset_password/{token}', [ResetPasswordController::class, 'create'])
    ->name('password.reset');

// Route to handle the password reset form submission
Route::post('reset_password', [ResetPasswordController::class, 'store'])
    ->name('password.update');

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

// search the all data
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [User_Authentication::class, 'search_users'])->name('dashboard');
});

// Destroy the Users Dashboard
Route::delete('/dashboard/{id}',[User_Authentication::class,'destroy'])->name('users.destroy');

// Donwload PDF
// Route::get('/dashboard/download-pdf', [User_Authentication::class, 'downloadPDF'])->name('users.downloadPDF');

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

// Admin Login

Route::get('/admin/login', [Admin_Dashboard::class, 'Admin_login'])->name('admin.login');
Route::post('/admin/login', [Admin_Dashboard::class, 'Login'])->name('admin.login.submit');
Route::get('/admin_dashboard', function () {
    return view('Admin.admin_dashboard'); // Adjust according to your view location
})->name('admin.dashboard')->middleware('auth');
// QueryString 

// Admin Profile

// Display the admin profile page
Route::get('/admin/profile', function() {
    return view('Admin.profile');
})->name('admin.profile');

// Handle the profile update
Route::post('/profile/update', [Admin_Dashboard::class, 'update'])->name('profile.update');


// Route::get('/index/{id}/{name}',function($id,$name){

//         return "ID is : " . $id . "  And Name is : " . $name;
// });

// Route::get('/index/Student',[PostController::class ,'store']);

// // Controller through Index Method
// Route::get('/index',[PostController::class, 'index']);

// // Foreach Result

