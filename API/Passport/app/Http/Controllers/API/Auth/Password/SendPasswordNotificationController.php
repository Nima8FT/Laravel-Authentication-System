<?php

namespace App\Http\Controllers\API\Auth\Password;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\PasswordNotificationRequest;

class SendPasswordNotificationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/forgot-password",
     *     summary="Send password reset link to user's email",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="nima.8ak@gmail.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success or user not found",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="status", type="integer", example=1),
     *                     @OA\Property(property="message", type="string", example="We’ve emailed you the password reset link. Please check your inbox!")
     *                 ),
     *                 @OA\Schema(
     *                     @OA\Property(property="status", type="integer", example=0),
     *                     @OA\Property(property="message", type="string", example="We can’t find a user with that email address.")
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="We couldn’t send the password reset email due to an error."),
     *             @OA\Property(property="message", type="string", example="Some exception message")
     *         )
     *     )
     * )
     */
    public function passwordNotification(PasswordNotificationRequest $request)
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
