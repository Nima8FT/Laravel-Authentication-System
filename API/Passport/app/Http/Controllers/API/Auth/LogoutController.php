<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout the authenticated user",
     *     description="Revoke the access token of the currently authenticated user using Laravel Passport.",
     *     tags={"Auth"},
     *     security={{"passport": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="User logged out successfully",
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
     *             @OA\Property(property="error", type="string", example="Oops! Something went wrong while logging out. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Internal server error message here")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json([
                'status' => 1,
                'message' => 'You have been logged out successfully. Come back soon!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Oops! Something went wrong while logging out. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
