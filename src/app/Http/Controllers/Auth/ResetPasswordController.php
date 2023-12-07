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

        if ($user) {
            $user->remember_token = bin2hex(random_bytes(8));
            $user->save();

            return response()->json(['exists' => true]);
        } else {
            // User with the provided email does not exist
            return response()->json(['exists' => false]);
        }
    }
}
