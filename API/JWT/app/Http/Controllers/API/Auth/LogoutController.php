<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
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
