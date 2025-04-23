<?php

namespace App\Http\Controllers\API\Auth\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendMailNotificationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/email/verification-notification",
     *     tags={"Authentication"},
     *     summary="Send verification email",
     *     description="Sends a verification email to the authenticated user.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Verification email sent",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Please check your email for the verification link.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error while sending email",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="We encountered an issue while sending the verification email. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message")
     *         )
     *     )
     * )
     */
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
