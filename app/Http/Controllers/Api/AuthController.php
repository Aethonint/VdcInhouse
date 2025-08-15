<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function driverLogin(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $data['email'])
            ->where('role', 'user') // optional filter if you store roles
            ->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // issue token (name it per device/app)
        $token = $user->createToken('driver-app')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->first_name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke only current token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
