<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     description="Logs in a user and returns a JWT token if credentials are correct.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="nima.8ak@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Login successful. Welcome back!"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="string", example="Nima Malakooti"),
     *                 @OA\Property(property="email", type="string", example="nima.8ak@gmail.com"),
     *                 @OA\Property(property="token", type="string", example="Bearer eyJ0eXAiOiJKV1QiLCJhbGci...")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="Unauthorized access. Please check your credentials and try again.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to login",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="Failed to login user. Please try again later."),
     *             @OA\Property(property="error", type="string", example="Exception message here")
     *         )
     *     )
     * )
     */
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
