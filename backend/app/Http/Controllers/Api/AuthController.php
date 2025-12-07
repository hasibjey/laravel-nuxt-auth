<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $message = null;
        $user = null;


        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            $message = "User registered successfully.";
        } catch (\Throwable $th) {
            $message = "Registration failed, please try again.";
        }

        return response()->json([
            'message' => $message,
        ]);
        
    }

    public function login(LoginRequest $request)
    {
        $user = $request->authenticate();
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 200);
    }
}
