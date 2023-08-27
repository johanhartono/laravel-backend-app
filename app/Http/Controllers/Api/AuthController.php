<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',

        ]);

        $user= User::where('email', $request->email)->first();

        if(!$user) {
            throw ValidationValidationException::withMessages([
                'email'=> 'email incorrect!'
            ]);
        }
        if(!Hash::check($request->password,$user->password)) {
            throw ValidationValidationException::withMessages([
                'password'=> 'password incorrect!'
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'jwt-token'=>$token,
            'user'=> new UserResource($user),
        ]);
    }

    public function logout(Request $request) {
        
    }
}
