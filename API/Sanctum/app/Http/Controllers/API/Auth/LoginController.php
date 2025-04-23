<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="Login user",
     *     description="Login a user with email and password, and return an authentication token.",
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
     *         description="User successfully logged in and token provided",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Login successful. Welcome back!"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="email", type="string", example="nima.8ak@gmail.com"),
     *                 @OA\Property(property="name", type="string", example="nima malakooti"),
     *                 @OA\Property(property="token", type="string", example="your-token-here")
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
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="Failed to login user. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message")
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
