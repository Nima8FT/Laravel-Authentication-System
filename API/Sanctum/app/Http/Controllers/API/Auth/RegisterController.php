<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Authentication"},
     *     summary="Register a new user",
     *     description="Register a new user with name, email, and password and return a user object with authentication token.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="nima malakooti"),
     *             @OA\Property(property="email", type="string", format="email", example="nima.8ak@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User successfully registered and token provided",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="User registered successfully."),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="name", type="string", example="nima malakooti"),
     *                 @OA\Property(property="email", type="string", example="nima.8ak@gmail.com"),
     *                 @OA\Property(property="token", type="string", example="your-token-here")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="Failed to register user. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Exception message")
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

            //create token for santcum
            $token = $user->createToken("Santcum")->plainTextToken;

            $response = $user->only("name", "email");
            $response["token"] = $token;

            return response()->json([
                'status' => 1,
                'message' => 'User registered successfully.',
                'user' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Failed to register user. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function profile()
    {
        try {
            return "jo";
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Failed to register user. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
