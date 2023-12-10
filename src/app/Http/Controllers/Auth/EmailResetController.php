<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmailResetController extends Controller
{
    public function emailReset(string $emailResetCode)
    {
        $decryptedData = Crypt::decrypt($emailResetCode);

        // Decode the JSON string
        $jsonUserData = json_decode($decryptedData);

        $email = $jsonUserData->email;
        $password = $jsonUserData->password;

        $user = User::where('email', $jsonUserData->email)->first();

        if ($user->reset_token !== $emailResetCode) {
            echo 'Something wrong, please try again';
        } else {
            // Update the password
            $user->password = Hash::make($jsonUserData->password);
            $user->reset_token = 'Confirm';
            $user->save();

            echo 'Password reset';
        }
    }
}
