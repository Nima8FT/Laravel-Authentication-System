<?php

namespace App\Http\Controllers\API\Auth\Password;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\NotificationPasswordRequest;

class NotificationPasswordController extends Controller
{
    public function passwordNotification(NotificationPasswordRequest $request)
    {
        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            if ($status === Password::ResetLinkSent) {
                return response()->json([
                    'status' => 1,
                    'message' => "We’ve emailed you the password reset link. Please check your inbox!",
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => "We can’t find a user with that email address.",
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'We couldn’t send the password reset email due to an error. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
