<?php

namespace App\Http\Controllers\API\Auth\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyMailController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/email/verify/{id}/{hash}",
     *     tags={"Authentication"},
     *     summary="Verify user email",
     *     description="Verifies the user's email using the verification link.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="hash",
     *         in="path",
     *         required=true,
     *         description="Email verification hash",
     *         @OA\Schema(type="string", example="9e4f889aabbc...")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email verified successfully",
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
     *             @OA\Property(property="message", type="string", example="Exception message")
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
