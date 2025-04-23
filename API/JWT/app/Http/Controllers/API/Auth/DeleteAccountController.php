<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteAccountController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/deleteAcconut",
     *     tags={"Authentication"},
     *     summary="Delete user account",
     *     description="Deletes the currently authenticated user's account and invalidates the JWT token.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Account deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Your account has been deleted successfully. We’re sorry to see you go.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Account deletion failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="We couldn’t delete your account at this moment. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message")
     *         )
     *     )
     * )
     */
    public function deleteAcconut()
    {
        try {
            $user = Auth::user();

            //invalided token jwt
            JWTAuth::invalidate(JWTAuth::getToken());

            $user->delete();

            return response()->json([
                "status" => 1,
                "message" => "Your account has been deleted successfully. We’re sorry to see you go."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'We couldn’t delete your account at this moment. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
