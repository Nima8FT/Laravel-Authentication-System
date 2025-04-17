<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\API\Auth\BaseController;

class RegisterController extends BaseController
{
    public function register(RegisterRequest $request)
    {
        try {
            $inputs = $request->only("name", "email", "password");
            $inputs["password"] = Hash::make($inputs["password"]);

            $user = User::create($inputs);

            //create a jwt token
            $token = JWTAuth::fromUser($user);

            $response = $user->only("name", "email");
            $response["token"] = $this->respondWithToken($token);

            return response()->json([
                "status" => 1,
                "message" => "User registered successfully.",
                "data" => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => 'Failed to register user. Please try again later.',
                "error" => $e->getMessage(),
            ]);
        }
    }
}
