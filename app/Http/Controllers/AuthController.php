<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
// use Illuminate\Http\Request;
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

        $user = User::create([
            'full_name' => $credentials['full_name'],
            'email' => $credentials['email'],
            'phone_number' => $credentials['phone_number'],
            'password' => Hash::make($credentials['password']),
            'role_id' => $credentials['role_id'],
            'division_id' => $credentials['division_id'],
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new AuthResource($user), // Use a resource for consistent formatting
        ], 201);
    }
}
