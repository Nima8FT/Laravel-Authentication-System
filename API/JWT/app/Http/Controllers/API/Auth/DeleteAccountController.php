<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteAccountController extends Controller
{
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
