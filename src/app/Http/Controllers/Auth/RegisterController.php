<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendConfirmRegisterLinkToEmailJob;
use App\Mail\SendRegisterLinkMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        //generate random code for email verified
        $id = $user->id;
        $randomCode = $id . '_' . bin2hex(random_bytes(8)); // Generates a random 8-character hexadecimal code

        //send verified link to email
        $link = "http://localhost:8000/$randomCode";
        dispatch(new SendConfirmRegisterLinkToEmailJob($link));

        //save verified link to field
        $user->email_verified_at = Carbon::now();
        $user->verified_code = $randomCode;
        $user->save();

        return response()->json($user);

//        $token = $user->createToken('personal-token', expiresAt:now()->addDay())->plainTextToken;
//
//        return response()->json(['token' => $token], 200);
    }




}
