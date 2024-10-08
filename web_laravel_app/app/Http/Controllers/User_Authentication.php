<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class User_Authentication extends Controller
{
    // Show Sign-in Form
    public function ShowSignin()
    {
        return view('login'); // Return the login view
    }

    // Handle Sign-in
    public function signin(Request $request)
    {
        // Validate the request data for login
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Check the credentials
        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Redirect to intended page or dashboard after successful login
            return redirect()->intended('/dashboard');
        }

        // Redirect back with error message if login fails
        return redirect('/login')->withErrors(['email' => 'User is Invalid. Please try again!']);
    }
    
    // Show Registration Form
    public function ShowRegister()
    {
        return view('register'); // Return the register view
    }

    // Handle Registration
    public function register(Request $request)
    {
        // Validate the request data for registration
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login with success message
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

    // Search all Users
    public function search_users(Request $request)
{
    $search = $request->input('search');
    $users = User::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%");
    })->paginate(2); // Paginate results

    return view('Vendor.dashboard', compact('users', 'search'));
}

// Delete Particular User in Dashboard

    public function destroy($id)
    {
        $user = User::find($id);

        if($user)
        {   
            $user->delete();
            return redirect()->back()->with("success","User Successfully deleted!");
        }

        else
        {
            return redirect()->back()->with("error","User is Not Found!");
        }
    }
   
    // Donwload PDF Users
    // public function downloadPDF()
    // {
    //     $users = User::all();
    //     $pdf = PDF::loadView('Vendor.pdf', compact('users'));
    //     return $pdf->download('Vendor.pdf');
    // }

    // Cookie Store
    public function setcookie($name, $value, $minutes = 60)
    {
         // Create the cookie
        $cookie = Cookie::make($name, $value, $minutes);

    // Store the cookie in the response
    return response()->json(['message' => 'Cookie set successfully'])->cookie($cookie);
    }

    public function getcookie($name)
    {
        // Retrieve the cookie value
        $value = Cookie::get($name);
    
        // Return a response with the cookie value
        return response()->json(['cookie_value' => $value]);
    }
}


