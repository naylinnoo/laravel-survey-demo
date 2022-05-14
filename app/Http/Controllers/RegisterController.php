<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->safe()->only(['name','email', 'password']);
        $user = User::firstOrNew([
            'email' => $credentials['email'],
            'name' => $credentials['name'],
            'password' => Hash::make($credentials['password']),
        ]);

        if($user->exists()){
            return response()->json([
                'message' => 'User already exists'
            ], 400);
        }
        $user->save();
        return response()
            ->json([
                'status' => 200,
                'message' => 'Successfully registered',
            ], 404);
    }
}
