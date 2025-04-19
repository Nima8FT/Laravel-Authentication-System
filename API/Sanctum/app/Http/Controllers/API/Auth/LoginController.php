<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only("email", "password");

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    "status" => 0,
                    "message" => "Unauthorized access. Please check your credentials and try again.",
                ]);
            }

            $user = Auth::user();

            //token for sanctum
            $token = $user->createToken("Sanctum")->plainTextToken;

            $response = $user->only("email", "name");
            $response["token"] = $token;

            return response()->json([
                "status" => 1,
                "message" => "Login successful. Welcome back!",
                "data" => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Failed to login user. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
