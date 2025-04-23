<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="Logout user",
     *     description="Logs out the currently authenticated user by invalidating the JWT token.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="You have been logged out successfully. Come back soon!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Logout failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="Oops! Something went wrong while logging out. Please try again later."),
     *             @OA\Property(property="error", type="string", example="Exception message")
     *         )
     *     )
     * )
     */
    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([
                'status' => 1,
                'message' => 'You have been logged out successfully. Come back soon!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => 'Oops! Something went wrong while logging out. Please try again later.',
                "error" => $e->getMessage(),
            ]);
        }
    }
}
