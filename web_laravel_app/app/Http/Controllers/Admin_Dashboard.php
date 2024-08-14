<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Admin_Dashboard extends Controller
{
    // Display the admin login view
    public function Admin_login()
    {
        return view('Admin.admin'); // The view should be named 'admin.blade.php'
    }

    // Handle the login request
    public function Login(Request $request)
    {
        // Validate the request data for login
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5',
        ]);

        // Hardcoded admin credentials
        $adminEmail = 'admin@gmail.com';
        $adminPassword = 'admin';

        // Check if the provided credentials match the hardcoded ones
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            // Manually log in the admin
            $admin = User::where('email', $adminEmail)->first();
            if ($admin && Auth::loginUsingId($admin->id)) {
                // Redirect to the admin dashboard after successful login
                return redirect()->intended('admin_dashboard');
            }
        }

        // Redirect back to login with an error message if login fails
        return redirect('/admin/login')->withErrors(['email' => 'Admin is Invalid. Please try again!']);
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'currentPassword' => 'required',
            'newPassword' => 'nullable|confirmed|min:6',
        ]);
    
        $user = Auth::user();
    
        // Check current password
        if ($request->currentPassword !== $user->password) {
            return back()->withErrors(['currentPassword' => 'Current password is incorrect.']);
        }
    
        // Update user details
        $user->email = $request->email;
    
        if ($request->newPassword) {
            $user->password = $request->newPassword;
        }
    
        $user->save();
    
        return back()->with('success', 'Profile updated successfully.');
    }

    // Show the Numbers are login in System
   
  
}


