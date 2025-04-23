<?php

namespace App\Http\Controllers\API\Auth\Password;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/reset-password",
     *     summary="Reset user password using token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password", "password_confirmation", "token"},
     *             @OA\Property(property="email", type="string", format="email", example="nima.8ak@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="new_secure_password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="new_secure_password"),
     *             @OA\Property(property="token", type="string", example="abcdef123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset successful or invalid token",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Your password has been reset!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="We couldn’t process the request due to an error. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message here")
     *         )
     *     )
     * )
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );
            if ($status === Password::PasswordReset) {
                return response()->json([
                    'status' => 1,
                    'message' => 'Your password has been reset!'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'message' => 'This password reset token is invalid.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'We couldn’t process the request due to an error. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
