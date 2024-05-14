<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'role' => 'required|string',

        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!Hash::check($request->password, $user->password)) {
            return response([
                'message' => "Password is wrong"
            ]);
        }

        $token = $user->createToken('api-key')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
    public function info(Request $request)
    {
        return $request->User();
    }
}
