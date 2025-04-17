<?php

namespace App\Http\Controllers\API\Auth\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyMailController extends Controller
{
    public function verifyMail(EmailVerificationRequest $request)
    {
        try {
            $request->fulfill();
            return response()->json([
                'status' => 1,
                'message' => 'Your email has been successfully verified. Thank you!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Your verification link was found, but something went wrong during the confirmation process. Please try again or request a new verification email.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
