<?php

namespace App\Http\Controllers;

use App\Services\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $this->logout();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc|max:255',
            'password' => 'required|string|min:8:255'
        ]);

        if ($validator->fails())
            return response()->json(['message' => $validator->errors()->all()], 400);

        if (!Auth::attempt($request->only(['email', 'password'])))
            return response()->json(['message' => 'Invalid user or password'], 400);

        $token = Str::random(60);
        $user = Auth::user();
        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();
        return $user;
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->forceFill([
                'api_token' => null,
            ])->save();
        }
        Auth::logout();
        return response()->json([], 204);
    }
}
