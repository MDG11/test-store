<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $input = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email',$input['email'])->first();
        if(!$user || !Hash::check($input['password'], $user->password)){
            return response([
                'message' => 'Wrong email/password'
            ], 401);
        }
        if($user->utype != 'ADM'){
            return response([
                'message' => 'User doesn`t have permissions to control API!'
            ], 401);
        }
        $token = $user->createToken('admintoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out!'
        ];
    }
}
