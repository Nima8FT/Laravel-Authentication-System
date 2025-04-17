<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only("email", "password");
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                //create token for table oauth_access_token
                $token = $user->createToken("Passport")->accessToken;

                $response = $user->only(["name", "email"]);
                $response["token"] = $token;

                return response()->json([
                    "status" => 1,
                    "message" => "Login successful. Welcome back!",
                    "data" => $response
                ]);
            }
            return response()->json([
                "status" => 0,
                "message" => "Unauthorized access. Please check your credentials and try again.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Failed to register user. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
