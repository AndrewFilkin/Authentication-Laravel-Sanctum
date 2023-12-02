<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class EmailVerifiedController extends Controller
{
    public function emailVerified(string $verificationCode)
    {
        $string = $verificationCode;
        $id = explode("_", $string);

        if (empty($id[0]) or count($id) === 1) {
            echo "No underscore found in the string.";
        } else {
            (int)$userId = $id[0];
            $user = User::find($userId);
            if ($user) {
                $user->email_verified_at = Carbon::now();
                $user->verified_code = "Successes";
                $user->save();

                $token = $user->createToken('personal-token', expiresAt: now()->addDay())->plainTextToken;
                echo 'You are login, ' . 'token: ' . $token . ' save';

//        return response()->json(['token' => $token], 200);
            } else {
                echo "User not found";
            }


        }
    }
}
