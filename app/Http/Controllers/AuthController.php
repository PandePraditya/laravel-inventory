<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $email = $credentials['email'];
        $password = $credentials['password'];

        // Check if the user email exists
        $user = User::where('email', $email)->first();

        // Check if the user password is correct
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        // Generate token with 1-week expiration
        $token = $user->createToken('auth_token', ['*'], now()->addWeek())->plainTextToken;

        $loginData = [
            'user' => $user,
            'token' => $token
        ];

        // Return as object
        return new AuthResource((object)$loginData);
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();
        // Hash the password
        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user)
        ], 201);
    }

    // Logout a user
    public function logout(Request $request)
    {
        // Get the token from the request
        $token = $request->bearerToken();

        // Check if the token is provided
        if (!$token) {
            return response()->json([
                'message' => 'Sorry, you must login first.',
            ], 400);
        }

        // Get the authenticated user using Sanctum
        $user = $request->user();

        // If user isn't authenticated, return unauthorized
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized. Token is invalid or user not found.',
            ], 401);
        }

        // Revoke the current token
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ]);
    }
}
