<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class MailController extends Controller
{
    public function notification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with("success", "Verification link sent!");
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }
}
