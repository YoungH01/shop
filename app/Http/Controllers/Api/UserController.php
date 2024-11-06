<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => Auth::guard('api')->user()
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email hoặc mật khẩu không đúng'],401);
        }
        if (Auth::guard('api')->user()->role == 'admin') {
            return response()->json(['error' => 'Email hoặc mật khẩu không đúng'],401);
        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        try {
            
            JWTAuth::parseToken()->invalidate();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to log out']);
        }
    }

    public function register(Request $request)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'customer',
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($userData);
        return response()->json(['message' => 'register success']);
    }
}
