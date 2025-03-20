<?php

namespace App\repository;

use App\Models\User;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository implements UserRepositoryInterface
{
    public function register( $data)
    {
        return User::create($data);
    }

    public function login($data): array|null
    {

        $user = auth::user();
        if (!$token = JWTAuth::attempt($data)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
