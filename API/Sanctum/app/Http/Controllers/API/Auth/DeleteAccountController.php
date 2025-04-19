<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
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
