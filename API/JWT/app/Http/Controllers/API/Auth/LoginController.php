<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
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
            $response = $user->only("email", "name");

            //create token for jwt
            $token = JWTAuth::fromUser($user);
            $response["token"] = $this->respondWithToken($token);

            return response()->json([
                "status" => 1,
                "message" => "Login successful. Welcome back!",
                "data" => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => 'Failed to login user. Please try again later.',
                "error" => $e->getMessage(),
            ]);
        }
    }
}
