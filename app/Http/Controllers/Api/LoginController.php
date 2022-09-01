<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(!auth()->attempt($credentials))
            abort(401, 'Invalid Credentials');

        $token = auth()->user()->createToken('auth_token');

        return response()->json(['data' => ['token' => $token->plainTextToken]]);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([], 204);
    }
}
