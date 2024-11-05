<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
    $user = User::create($request -> all());
    return response()->json($user);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'No autorizado'], 401);
        }
        $admin = Auth::guard('api')->user();

        return $this->respondWithToken($token,  $admin);
    }

    protected function respondWithToken($token, $admin)
    {
        return response()->json([
            'access_token' => $token, 
            'token_type' => 'bearer', 
            'expires_in' => Auth::factory()->getTTL() * 60, 
            'admin' => $admin,
        ]);
    }
}   