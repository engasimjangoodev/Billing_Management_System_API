<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $valiData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        $valiData['password'] = bcrypt($request->password);
        $user = User::create($valiData);
        $accessToken = $user->createToken('auth_Token')->accessToken;
        return response(['user' => $user, 'accessToken' => $accessToken]);

    }

    public function login(Request $request)
    {
        $LoginData = $request->validate([

            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($LoginData)) {
            return response(['Meassage' => "Data is not valeted " ],422);

        }

        $accessToken = auth()->user()->createToken('Auth_user_token')->accessToken;
        return response(['user' => auth()->user(), 'accessToken' => $accessToken]);


    }


}
