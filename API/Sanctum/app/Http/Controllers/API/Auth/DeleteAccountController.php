<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/deleteAccount",
     *     tags={"Authentication"},
     *     summary="Delete user account",
     *     description="Deletes the user's account and invalidates their tokens.",
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
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="We couldn’t delete your account at this moment. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message")
     *         )
     *     )
     * )
     */
    public function deleteAccount(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
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
