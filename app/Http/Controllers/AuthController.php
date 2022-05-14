<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(LoginRequest $request): UserResource|\Illuminate\Http\JsonResponse
    {

        $credentials = $request->safe()->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return new UserResource(Auth::user());
        }
        return response()
            ->json([
                'status' => 404,
                'message' => 'Wrong Credentials'
            ], 404);

    }

    public function logout(){
        $user = Auth::user();
        $token = $user->tokens()->where('id', $user->currentAccessToken()->id);
        return response()
            ->json([
                'status' => 200,
                'message' =>$token
            ], 404);
    }
}
