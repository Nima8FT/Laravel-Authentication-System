<?php

namespace App\Http\Controllers\API\Auth\Password;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\NotificationPasswordRequest;

class NotificationPasswordController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/forgot-password",
     *     tags={"Authentication"},
     *     summary="Send password reset link",
     *     description="Sends a password reset link to the user's email address.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="nima.8ak@gmail.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset link sent or email not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="We’ve emailed you the password reset link. Please check your inbox!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to send password reset email",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="We couldn’t send the password reset email due to an error. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message")
     *         )
     *     )
     * )
     */
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
