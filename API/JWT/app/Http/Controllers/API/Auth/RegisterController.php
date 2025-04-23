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
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     description="Registers a user and returns a JWT token.",
     *     operationId="registerUser",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Nima Malakooti"),
     *             @OA\Property(property="email", type="string", format="email", example="nima.8ak@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="12345678"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="User registered successfully."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="string", example="Nima Malakooti"),
     *                 @OA\Property(property="email", type="string", example="nima.8ak@gmail.com"),
     *                 @OA\Property(property="token", type="string", example="Bearer eyJ0eXAiOiJKV1...")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Registration failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="Failed to register user. Please try again later."),
     *             @OA\Property(property="error", type="string", example="Detailed error message")
     *         )
     *     )
     * )
     */
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
