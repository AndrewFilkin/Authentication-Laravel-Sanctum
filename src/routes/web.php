<?php

use App\Http\Controllers\Auth\EmailVerifiedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SentMailRegisterLinkController;
use App\Http\Controllers\Auth\EmailResetController;

Route::get('/send', [SentMailRegisterLinkController::class, 'send'])->name('send.to.email.register.link');

Route::get('email-verified/{verificationCode}', [EmailVerifiedController::class, 'emailVerified'])->name('email-verified');
Route::get('email-reset/{verificationCode}', [EmailResetController::class, 'emailReset'])->name('email-reset');
