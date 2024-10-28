<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $user = User::where('email', $loginRequest->input('email'))->first();

        if (!$user || !Hash::check($loginRequest->input('password'), $user->password)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('myToken')->accessToken;

        return response()->json([
            'success' => 'Login successful.',
            'token' => $token
        ], 200);
    }


    public function register(RegisterRequest $registerRequest)
    {
        User::create([
            'name' => $registerRequest->input('name'),
            'email' => $registerRequest->input('email'),
            'password' => Hash::make($registerRequest->input('password')),
        ]);

        return response()->json([
            'success' => 'Registration successful.',
        ], 200);
    }


    public function profile(ProfileRequest $profileRequest)
    {
        $user = Auth::guard('api')->user();
        return response()->json([
            'user' => $user,
            'success' => 'get data successful.'
        ]);
    }

    public function getToken()
    {
        $user = Auth::guard('api')->user();
        return response()->json([
            'token' => $user->token()
        ]);
    }


    public function logout()
    {
        $user = Auth::guard('api')->user();
        $token = $user->token();
        // delete token 
        $token->revoke();
        return response()->json([
            'success' => 'true',
            'message' => 'Logout successful.',
            'token' => $user->token()
        ]);
    }
}
