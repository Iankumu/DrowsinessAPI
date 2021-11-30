<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedEmail = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validatedEmail->fails()) {
            return response()->json([
                'error' => 'Duplicate Email found',
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Duplicate Email detected. Please input another email'
            ], Response::HTTP_UNPROCESSABLE_ENTITY); //422
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',

        ]);

        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        // sends a verification email once registration is done
        // event(new Registered($user));
        $accessToken = $user->createToken('authToken')->accessToken;
        return response([
            'user'=>$user,
            'access_token' => $accessToken
        ], Response::HTTP_OK); //200

    }
    public function login(Request $request)
    {
        $loginData = $request->validate([

            'email' => 'email|required',
            'password' => 'required',

        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'invalid credentials'], Response::HTTP_UNAUTHORIZED); //401

        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ], Response::HTTP_OK); //Status 200
    }
}
