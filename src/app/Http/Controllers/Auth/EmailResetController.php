<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EmailResetController extends Controller
{
    public function emailReset(string $emailResetCode)
    {
        $decryptedData = Crypt::decrypt($emailResetCode);
        echo $decryptedData;
    }
}
