<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->only('email','password')))
        {
            return response([
                'error' => 'Invalid Credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

//        $user = Auth::user();
        return response([
            'message' => 'success ',
        ]);


    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(
            $request->only('first_name','last_name','email')+[
                'password' => Hash::make($request->input('password')),
            ]
        );

        return response($user, Response::HTTP_CREATED);
    }

    public function user(Request $request)
    {
         return $request->user();
    }

    public function logout()
    {
        // Remove the token from the Authenticated
        Auth::logout();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
