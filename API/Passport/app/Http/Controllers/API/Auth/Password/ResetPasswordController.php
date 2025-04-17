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
