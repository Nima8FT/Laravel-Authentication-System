<?php

namespace App\Http\Controllers\API\Auth\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyMailController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/email/verify",
     *     summary="Verify user email",
     *     tags={"Auth"},
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "verification_token"},
     *             @OA\Property(property="email", type="string", format="email", example="nima@example.com"),
     *             @OA\Property(property="verification_token", type="string", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email successfully verified",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Your email has been successfully verified. Thank you!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Verification failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="Your verification link was found, but something went wrong during the confirmation process. Please try again or request a new verification email."),
     *             @OA\Property(property="message", type="string", example="Exception details here")
     *         )
     *     )
     * )
     */
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
