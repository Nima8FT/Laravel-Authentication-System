<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login user and get access token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="nima@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="Login successful. Welcome back!"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="Nima Malakooti"),
     *                 @OA\Property(property="email", type="string", example="nima@example.com"),
     *                 @OA\Property(property="token", type="string", example="access_token_string")
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
     *         description="Login failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=0),
     *             @OA\Property(property="error", type="string", example="Failed to login user. Please try again later."),
     *             @OA\Property(property="message", type="string", example="Some internal error message...")
     *         )
     *     )
     * )
     */
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
                'error' => 'Failed to login user. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
