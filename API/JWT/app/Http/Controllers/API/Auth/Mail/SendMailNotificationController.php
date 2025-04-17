<?php

namespace App\Http\Controllers\API\Auth\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendMailNotificationController extends Controller
{
    public function mailNotification(Request $request)
    {
        try {
            $request->user()->SendEmailVerificationNotification();
            return response()->json([
                'status' => 1,
                'message' => 'Please check your email for the verification link.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'We encountered an issue while sending the verification email. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
