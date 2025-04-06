<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "username" => ["required", "string"],
            "password" => ["required"],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(["message" => "Invalid credentials"], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Login successful",
            "data" => ["user" => $user, "token" => $token]
        ], Response::HTTP_OK);

        // if (Auth::attempt($credentials)) {
        //     // $request->session()->regenerate();
        //     $user = Auth::user();
        //     $token = $user->createToken("auth_token")->plainTextToken;
        //     return response()->json([
        //         "message" => "Login successful",
        //         "data" => [
        //             "user" => Auth::user(),
        //             "token" => $token,
        //         ]
        //     ]);
        // }
        // return response()->json([
        //     "message" => "Invalid credentials",
        // ], Response::HTTP_UNAUTHORIZED);
    }
}
