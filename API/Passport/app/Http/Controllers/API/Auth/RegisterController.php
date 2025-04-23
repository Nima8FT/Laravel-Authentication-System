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
     *     summary="Register a new user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Nima Malakooti"),
     *             @OA\Property(property="email", type="string", format="email", example="nima@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="User registered successfully."),
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="Nima Malakooti"),
     *                 @OA\Property(property="email", type="string", example="nima@example.com"),
     *                 @OA\Property(property="token", type="string", example="access_token_string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Registration failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="Failed to register user. Please try again later."),
     *             @OA\Property(property="message", type="string", example="SQLSTATE[23000]: Integrity constraint violation...")
     *         )
     *     )
     * )
     */
    public function register(RegisterRequest $request)
    {
        try {
            $inputs = $request->only(['name', 'email', 'password']);
            $inputs["password"] = Hash::make($inputs["password"]);

            $user = User::create($inputs);

            //create token for table oauth_access_token
            $token = $user->createToken("Passport")->accessToken;

            $response = $user->only(["name", "email"]);
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
}
