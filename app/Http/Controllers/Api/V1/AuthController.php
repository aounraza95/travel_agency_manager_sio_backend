<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'string|in:admin,user'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'role' => $fields['role'] ?? 'user'
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'User registered successfully', 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return $this->error('Bad credentials', 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return $this->success(null, 'Logged out');
    }
}
