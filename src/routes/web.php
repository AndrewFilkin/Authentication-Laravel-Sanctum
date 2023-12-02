<?php

use App\Http\Controllers\Auth\EmailVerifiedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SentMailRegisterLinkController;

Route::get('/send', [SentMailRegisterLinkController::class, 'send'])->name('send.to.email.register.link');

Route::get('email-verified/{verificationCode}', [EmailVerifiedController::class, 'emailVerified'])->name('email-verified');
