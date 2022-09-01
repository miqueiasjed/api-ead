<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->all();

        if (!Auth::attempt($data)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
