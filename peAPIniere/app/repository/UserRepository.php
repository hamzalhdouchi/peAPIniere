<?php

namespace App\repository;

use App\Models\User;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository implements UserRepositoryInterface
{
    public function register( $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        return $user;
    }


    public function login($request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return false;
        }

        $user = auth()->user();

        return [
            'user' => $user,
            'token' => $token
        ];
    }

}
