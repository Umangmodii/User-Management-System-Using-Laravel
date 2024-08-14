<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Notifications\CustomResetPassword;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            // Notify the user with the custom notification
            $user = \App\Models\User::where('email', $request->input('email'))->first();
            if ($user) {
                $user->notify(new CustomResetPassword($status));
            }

            return back()->with(['status' => __('A password reset link has been sent to your email address.')]);
        }

        return back()->withErrors(['email' => __('We couldn\'t find an account with that email.')]);
    }
}
