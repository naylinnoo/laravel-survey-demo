<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
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
