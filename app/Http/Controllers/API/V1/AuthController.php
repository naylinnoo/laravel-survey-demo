<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\v1\UserResource;
use Illuminate\Support\Facades\Auth;
use function response;

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
