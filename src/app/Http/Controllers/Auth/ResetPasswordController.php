<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function sendResetPassLinkToEmail(Request $request)
    {
        $email = $request->input('email');

        // Check if the user with the given email exists
        $user = User::where('email', $email)->first();


//        return response()->json($user->remember_token);

        if (empty($user->remember_token) or $user->remember_token == 'Confirm') {
            $user->remember_token = bin2hex(random_bytes(8));
            $user->save();
            return response()->json(['message' => 'Code send on your email, please confirm']);
        } else {
            return response()->json(['token' => "token is sent, please check your email"]);
        }
    }
}
