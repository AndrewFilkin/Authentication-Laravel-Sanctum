<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendRegisterLinkMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


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

        Mail::to('recipient@example.com')->send(new SendRegisterLinkMail($link));
        return response()->json($link);

//        $token = $user->createToken('personal-token', expiresAt:now()->addDay())->plainTextToken;
//
//        return response()->json(['token' => $token], 200);
    }




}
