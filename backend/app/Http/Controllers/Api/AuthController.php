<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully!',
        ], 200);
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        VerificationCode::updateOrInsert(
            ['identifier' => $request->email],
            [
                'code' => rand(10000, 99999),
                'created_at' => Carbon::now()
            ]
        );

        return response()->json([
            'message' => 'your forgot password verification code send you email!'
        ]);
    }

    public function verification(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:verification_codes,identifier',
            'code' => 'required|exists:verification_codes,code'
        ]);

        $verify = VerificationCode::where('identifier', $request->email)->where('code', $request->code)->first();

        if ($verify) {
            $createdAt = $verify->created_at;
            $currentTime = Carbon::now();
            $diffInMinutes = $currentTime->diffInMinutes($createdAt, true);

            if ($diffInMinutes < 2) {
                return response()->json([
                    'email' => $request->email,
                    'message' => 'Verification successful!'
                ], 200);
            } else {
                return response()->json([
                    'email' => $request->email,
                    'message' => 'Verification code expired!'
                ], 201);
            }
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email|exists:verification_codes,identifier',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password),
            ]);

            VerificationCode::where('identifier', $request->email)->delete();

            return response()->json([
                'message' => 'Your password was reset successfully!'
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Password reset failed. Please try again.'
            ],201);
        }

        

        
    }
}
