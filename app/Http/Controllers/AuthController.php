<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']);
        $token = auth()->attempt($credentials);
        if (!$token) return response()->json(['error' => 'invalid email or password'], 403);
        return response()->json(['token' => $token], 200);
    }

    public function me()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }
}
