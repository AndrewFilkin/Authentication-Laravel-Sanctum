<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\SendResetRegisterLinkToEmailJob;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class ResetPasswordController extends Controller
{
    public function sendResetPassLinkToEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $email = $request->input('email');
        $password = $request->input('password');
//      data for send email
        $data = [
            'email'    => $email,
            'password' => $password,
        ];
        $jsonString = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $oneLineJsonString = str_replace(' ', '', $jsonString);
        $encryptedJson = Crypt::encrypt($oneLineJsonString);

//        $decryptedData = Crypt::decrypt($encryptedJson);

        // Check if the user with the given email exists
        $user = User::where('email', $email)->first();

//        return response()->json($user->remember_token);

        if (empty($user->remember_token) or $user->remember_token == 'Confirm') {
            $user->remember_token = $encryptedJson;
            $user->save();

            $resetLink = "http://localhost:8000/email-reset/$encryptedJson";
            dispatch(new SendResetRegisterLinkToEmailJob($resetLink));

            return response()->json(['message' => 'Code send on your email, please confirm']);
        } else {
            return response()->json(['token' => "token is sent, please check your email"]);
        }
    }
}
