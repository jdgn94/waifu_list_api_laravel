<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "username" => ["required", "string"],
            "password" => ["required"],
        ]);

        if (!$token = auth(guard: 'api')->attempt($credentials)) {
            return response()->json([
                "message" => "Invalid credentials",
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            "message" => "Login successful",
            "data" => [
                "user" => auth(guard: 'api')->user()->me(),
                "token" => $token,
            ]
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        try {
            auth()->logout();
            return response()->json([
                "message" => "Logout successful",
            ], Response::HTTP_OK);
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            return response()->json([
                "message" => "Token invalid",
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = auth()->user()->me();

            return response()->json([
                "message" => "User found",
                "data" => [
                    "user" => $user,
                ]
            ], Response::HTTP_OK);
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            return response()->json([
                "message" => "User not found",
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
