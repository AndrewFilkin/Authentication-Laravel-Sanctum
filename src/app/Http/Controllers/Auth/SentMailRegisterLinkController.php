<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendConfirmRegisterLinkToEmailJob;

class SentMailRegisterLinkController extends Controller
{
    public function send()
    {
        dispatch(new SendConfirmRegisterLinkToEmailJob());
    }

}
