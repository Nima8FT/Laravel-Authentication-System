<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteAccountController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/deleteAccount",
     *     summary="Delete user account",
     *     tags={"Auth"},
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Account successfully deleted",
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
     *             @OA\Property(property="message", type="string", example="Exception details here")
     *         )
     *     )
     * )
     */
    public function deleteAccount(Request $request)
    {
        try {
            $user = $request->user();

            //delete token this user in table oauth_access_token
            $user->tokens()->delete();

            $user->delete();

            return response()->json([
                "status" => 1,
                "message" => "Your account has been deleted successfully. We’re sorry to see you go."
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'status' => 0,
                'error' => 'We couldn’t delete your account at this moment. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
