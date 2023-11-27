<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegisterLinkMail;

class SentMailRegisterLinkController extends Controller
{
    public function send()
    {
        $link = 'https://google.com';
        Mail::to('recipient@example.com')->send(new SendRegisterLinkMail($link));
    }
}
